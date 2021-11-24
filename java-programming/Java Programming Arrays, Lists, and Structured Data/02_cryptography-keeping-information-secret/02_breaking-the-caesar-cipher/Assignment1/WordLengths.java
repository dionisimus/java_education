import java.util.Arrays;
import edu.duke.*;
import java.io.*;


public class WordLengths
{
        public void countWordLengths (FileResource resource, int [] counts, String [] words)
    {
            int counterWords = 0;
            for (String word : resource.words()){
                int nonChar = 0;
                int wordLength = 0;
                if (!Character.isLetter(word.charAt(0))){
                    nonChar++;
                }
                if (!Character.isLetter(word.charAt(word.length()-1))){
                    nonChar++;
                }
                if (word.length() > counts.length-1){
                    counts[counts.length-1]++;
                    if (words[counts.length-1] == null)
                        words[counts.length-1] = word;
                    else 
                        words[counts.length-1] += " " + word;
                }
                else{
                    wordLength = word.length() - nonChar;
                    counts[wordLength]++;
                    if (words[wordLength] == null)
                        words[wordLength] = word;
                    else
                        words[wordLength] += " " + word;
                }
            } 
    }
 
    public int  indexOfMax (int [] values){
        int maxEl = 0;
        int maxI = 0;
        for (int i = 0; i < values.length; i++){
            
            if (maxI == 0 && values[i] > 0){
                maxI = values[i];
                maxEl = i;
            }
            if (values[i] > maxI){
                maxI = values[i];
                maxEl = i;
            }
        }
        return maxI;
    }
    
    public void testCountWordLengths ()
    {
       FileResource fr = new FileResource();
       int[] counts = new int[31];
       String [] words = new String [counts.length];
       countWordLengths(fr, counts, words);
       for (int i = 0; i < counts.length; i++){
           if (counts[i] != 0)
           System.out.println(counts[i] + " words of length " + i + ": " + words[i]);
       }
       
       indexOfMax(counts);
    }
}