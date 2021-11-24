import edu.duke.*;

public class CaesarCipher
{
    public String encrypt (String input, int key){
        StringBuilder str = new StringBuilder(input);
        String Alph = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        String encrAlph = Alph.substring(key) + Alph.substring(0,key);
        
        for(int i = 0; i < str.length(); i++){
            int findInt = 0;
            char findChar = str.charAt(i);
            if (Character.isUpperCase(findChar)){
                findInt = Alph.indexOf(findChar);
                if (findInt != -1){
                    char newChar = encrAlph.charAt(findInt);
                    str.setCharAt(i,newChar);
                }
            }
            if (Character.isLowerCase(findChar)){
                findInt = Alph.indexOf(Character.toUpperCase(findChar));
                if (findInt != -1){
                    char newChar = encrAlph.charAt(findInt);
                    str.setCharAt(i,Character.toLowerCase(newChar));
                }
            }
            
        }
        return str.toString();
        
    }
    
    public void testCaesar (){ 
        int key = 17;
        FileResource fr = new FileResource();
        String message = fr.asString();
        String encrypted = encrypt(message, key);
        System.out.println("key is " + key + "\n" + encrypted);
    }
    
    public char Encryption (int key, char ch){
        String Alph = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        String encrAlph1 = Alph.substring(key) + Alph.substring(0,key);
        int findInt = 0;
        char newChar = 0;
        if (Character.isLetter(ch)){
            if (Character.isUpperCase(ch)){
                    findInt = Alph.indexOf(ch);
                    if (findInt != -1){
                        newChar = encrAlph1.charAt(findInt);
                        
                    }
                }
            if (Character.isLowerCase(ch)){
                    findInt = Alph.indexOf(Character.toUpperCase(ch));
                    if (findInt != -1){
                        newChar = encrAlph1.charAt(findInt);
                        newChar = Character.toLowerCase(newChar);
                        
                    }
                }
        return newChar;
        }
        else{
        return ch;
        }
    }

    public String encryptTwoKeys (String input, int key1, int key2){
        StringBuilder replaced = new StringBuilder(input);
        char findChar;
        for (int i = 0; i < replaced.length(); i++){
            findChar = replaced.charAt(i);
            if (i % 2 == 0)
                replaced.setCharAt(i,Encryption(key1,findChar));
                
            if (i % 2 != 0)
                replaced.setCharAt(i,Encryption(key2,findChar));
        }
        System.out.println(replaced.toString());
        return replaced.toString();
    }
}
