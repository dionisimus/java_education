import java.util.*;
import edu.duke.*;
import java.io.File;

public class VigenereBreaker {
    
    public String sliceString(String message, int whichSlice, int totalSlices) {
        //REPLACE WITH YOUR CODE
        StringBuilder sb = new StringBuilder();
        for (int i = whichSlice;i<message.length();i+=totalSlices){
            sb.append(message.charAt(i));
        }
        return sb.toString();
    }

    public int[] tryKeyLength(String encrypted, int klength, char mostCommon) {
        int[] key = new int[klength];
        
        CaesarCracker cc = new CaesarCracker(mostCommon);
        //WRITE YOUR CODE HERE
        for (int i = 0; i<klength;i++){
            
            key[i]=cc.getKey(sliceString(encrypted,i,klength));
             
        }
        return key;
    }

    public void breakVigenere () {
        //WRITE YOUR CODE HERE
        FileResource frEnc = new FileResource("VigenereTestData/athens_keyflute.txt");
        // FileResource frDict = new FileResource("dictionaries/English");
        //frEnc.asString();
        // System.out.println(breakForLanguage(frEnc.asString(),readDictionary(frDict)));
        
        HashMap <String,HashSet <String>> languages = new HashMap <String,HashSet <String>>();
        
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()){
            String nameDict = f.getName();
            FileResource frDictTmp = new FileResource("dictionaries/"+nameDict);
            HashSet <String> words = new HashSet <String>();
            for (String word:frDictTmp.words()){
                words.add(word);
            }
            languages.put(nameDict,words);
            System.out.println(nameDict+" dict added");
        }
        //breakForAllLangs(String encrypted, HashMap <String,HashSet<String>> languages)
        
        
        breakForAllLangs(frEnc.asString(), languages);
    }
    
    public HashSet<String> readDictionary(FileResource fr){
        HashSet<String> set = new HashSet<String>();
        for (String words : fr.words()){
            set.add((words.toLowerCase()));
        }
        return set;
        
    }
    
    public int countWords(String message, HashSet dictionary){
        String [] wordsArr = message.split("\\W+");
        int realWords = 0;
        for (String word : wordsArr){
            if (dictionary.contains(word)){
                realWords++;
            }
        }
        return realWords;
    }
    
    public String breakForLanguage(String encrypted, HashSet<String> dictionary){
        VigenereCipher vcFor = new VigenereCipher(tryKeyLength(encrypted,0,'e'));
        int max = 0;
        int key = 0;
        
        for (int i = 1; i <=100;i++){
            vcFor = new VigenereCipher(tryKeyLength(encrypted,i,mostCommonCharIn(dictionary)));
            if (countWords(vcFor.decrypt(encrypted),dictionary)>max){
                max = countWords(vcFor.decrypt(encrypted),dictionary);
                key=i;

            }
        }
        VigenereCipher vc = new VigenereCipher(tryKeyLength(encrypted,key,'e'));
        return vc.decrypt(encrypted);
    }
    
    public char mostCommonCharIn(HashSet<String> dictionary){
        StringBuilder alphBuilder = new StringBuilder("abcdefghijklmnopqrstuvwxyz");
        String alph = "abcdefghijklmnopqrstuvwxyz";
        int[] counts = new int[26];
        for (String word : dictionary){
            StringBuilder wordCh = new StringBuilder(word);
            for(int i=0;i<wordCh.length();i++){
                int charFound = alph.indexOf(Character.toLowerCase(wordCh.charAt(i)));
                if (charFound != -1){
                    counts[charFound] += 1;
                }
                
            }
            
        }
        int max = 0;
        int alphCount = 0;
        int counter = 0;
        for (int count : counts){
            
            if (count > max){
                max = count;
                alphCount = counter;
            }
            ++counter;
        }
        
        
        return alphBuilder.charAt(alphCount);
    }
    
    public void  breakForAllLangs(String encrypted, HashMap <String,HashSet<String>> languages){
        int max = 0;
        String decodedFinal = "";
        String langFinal = "";
        for (String lang : languages.keySet()){
            HashSet curDict = languages.get(lang);
            String decoded = breakForLanguage(encrypted,curDict);
            //countWords(String message, HashSet dictionary);
            if (countWords(decoded,curDict)>max){
                max = countWords(decoded,curDict);
                decodedFinal = decoded;
                langFinal = lang;
            }
        }
        System.out.println(langFinal);
        System.out.println(decodedFinal);
    }
}
