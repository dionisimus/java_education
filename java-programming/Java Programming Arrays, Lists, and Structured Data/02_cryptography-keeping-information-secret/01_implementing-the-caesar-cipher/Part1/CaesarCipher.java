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
    
    public String encryptTwoKeys (String input, int key1, int key2){
        StringBuilder replaced = new StringBuilder(input);
        for (int i = 0; i < replaced.length(); i++){
            if ((i+1) % 2 == 0)
                encrypt(input, key2);
            if ((i+1) % 2 != 0)
                encrypt(input, key1);
        }
        return replaced.toString();
    }
}
