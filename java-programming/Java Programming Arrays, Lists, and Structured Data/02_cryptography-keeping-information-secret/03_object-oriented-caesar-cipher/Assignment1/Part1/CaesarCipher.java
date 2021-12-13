
public class CaesarCipher 
{
    // instance variables - replace the example below with your own
    private String alphabet;
    private String shiftedAlphabet;
    private int mainKey;

    /**
     * Constructor for objects of class Part1
     */
    public CaesarCipher(int key)
    {
        // initialise instance variables
        alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        shiftedAlphabet = alphabet.substring(key) + alphabet.substring(0,key);
        mainKey = key;
    }

       
    public String encrypt(String input)
    {
        StringBuilder str = new StringBuilder(input);
     
        for(int i = 0; i < str.length(); i++){
            int findInt = 0;
            char findChar = str.charAt(i);
            if (Character.isUpperCase(findChar)){
                findInt = alphabet.indexOf(findChar);
                if (findInt != -1){
                    char newChar = shiftedAlphabet.charAt(findInt);
                    str.setCharAt(i,newChar);
                }
            }
            if (Character.isLowerCase(findChar)){
                findInt = alphabet.indexOf(Character.toUpperCase(findChar));
                if (findInt != -1){
                    char newChar = shiftedAlphabet.charAt(findInt);
                    str.setCharAt(i,Character.toLowerCase(newChar));
                }
            }
            
        }
        return str.toString();
    }
    
    public String decrypt(String input)
    {
        CaesarCipher cc = new CaesarCipher(26 - mainKey);
        return cc.encrypt(input);
    }
}