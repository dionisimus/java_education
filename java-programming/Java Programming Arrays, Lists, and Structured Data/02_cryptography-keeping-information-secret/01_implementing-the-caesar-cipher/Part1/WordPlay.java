import java.io.*;
import java.lang.StringBuilder.*;

public class WordPlay{
    
    public boolean isVowel(char ch){
        char noCase = Character.toLowerCase(ch);
        if (noCase == 'a'||noCase == 'e'||noCase == 'i'||noCase == 'o'||
        noCase == 'o'||noCase == 'u')
            return true;
        else 
            return false;
    }
    
    public String replaceVowels (String phrase, char ch){
        StringBuilder replaced = new StringBuilder(phrase);
        
        for (int i = 0; i < replaced.length(); i++){
         
        if (isVowel(phrase.charAt(i)))
        replaced.setCharAt(i,ch);
        
        }
        return replaced.toString();
    }
    
    public String emphasize (String phrase, char ch){
        StringBuilder replaced = new StringBuilder(phrase);
        for (int i = 0; i < replaced.length(); i++){
            char index = Character.toLowerCase(replaced.charAt(i));
            if (index == ch && (i+1) % 2 == 0)
                replaced.setCharAt(i, '+');
            if (index == ch && (i+1) % 2 != 0)
                replaced.setCharAt(i, '*');
        }
        return replaced.toString();
    }
}