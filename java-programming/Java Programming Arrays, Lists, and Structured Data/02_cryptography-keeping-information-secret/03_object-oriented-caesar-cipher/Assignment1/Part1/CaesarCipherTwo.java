

public class CaesarCipherTwo
{
    // instance variables - replace the example below with your own
    private String alphabet;
    private String shiftedAlphabet1;
    private String shiftedAlphabet2;
    private String decryptAlphabet1;
    private String decryptAlphabet2;
    
    /**
     * Constructor for objects of class CaesarCipherTwo
     */
    public CaesarCipherTwo(int key1, int key2)
    {
        // initialise instance variables
        alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        shiftedAlphabet1 = alphabet.substring(key1) + alphabet.substring(0,key1);
        shiftedAlphabet2 = alphabet.substring(key2) + alphabet.substring(0,key2);
        
        decryptAlphabet1 = alphabet.substring(26-key1) + alphabet.substring(0,26-key1);
        decryptAlphabet2 = alphabet.substring(26-key2) + alphabet.substring(0,26-key2);
    }

        public char Encryption (String shiftedAlphabet, char ch){
        int findInt = 0;
        char newChar = 0;
        if (Character.isLetter(ch)){
            if (Character.isUpperCase(ch)){
                    findInt = alphabet.indexOf(ch);
                    if (findInt != -1){
                        newChar = shiftedAlphabet.charAt(findInt);
                        
                    }
                }
            if (Character.isLowerCase(ch)){
                    findInt = alphabet.indexOf(Character.toUpperCase(ch));
                    if (findInt != -1){
                        newChar = shiftedAlphabet.charAt(findInt);
                        newChar = Character.toLowerCase(newChar);
                        
                    }
                }
        return newChar;
        }
        else{
        return ch;
        }
    }
    
    
    public String encrypt (String input)
    {
        StringBuilder replaced = new StringBuilder(input);
        char findChar;
        for (int i = 0; i < replaced.length(); i++){
            findChar = replaced.charAt(i);
            if (i % 2 == 0)
                replaced.setCharAt(i,Encryption(shiftedAlphabet1,findChar));
                
            if (i % 2 != 0)
                replaced.setCharAt(i,Encryption(shiftedAlphabet2,findChar));
        }
        
        return replaced.toString();
    }
        
    
    public String  decrypt (String input) {
        StringBuilder replaced = new StringBuilder(input);
        char findChar;
        for (int i = 0; i < replaced.length(); i++){
            findChar = replaced.charAt(i);
            if (i % 2 == 0)
                replaced.setCharAt(i,Encryption(decryptAlphabet1,findChar));
                
            if (i % 2 != 0)
                replaced.setCharAt(i,Encryption(decryptAlphabet2,findChar));
        }
        
        return replaced.toString();
    }
}
