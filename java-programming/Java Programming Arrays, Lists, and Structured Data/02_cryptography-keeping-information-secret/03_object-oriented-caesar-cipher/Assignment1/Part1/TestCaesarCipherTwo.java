import edu.duke.*;

public class TestCaesarCipherTwo
{
    // instance variables - replace the example below with your own
    private String alphabet;

    /**
     * Constructor for objects of class TestCaesarCipherTwo
     */
    public TestCaesarCipherTwo()
    {
        // initialise instance variables
        alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }

    
    public int maxIndex(int[] freqs) {
        int max = Integer.MIN_VALUE;
        int maxIndex = -1;
        
        for (int i = 0; i < freqs.length; i++) {
            if (freqs[i] > max) {
                max = freqs[i];
                maxIndex = i;
            }
        }
        
        return maxIndex;
    }
    
    
    public int[] countLetters(String encrypted) {
        int[] counts = new int[26];
                
        for (int i = 0; i < encrypted.length(); i++) {
            int index = alphabet.indexOf(Character.toLowerCase(encrypted.charAt(i)));
            
            if (index != -1) {
                counts[index]++;
            }
        }
        
        return counts;
    }
    
    public String halfOfString(String message, int start){
        StringBuilder two = new StringBuilder();
        // StringBuilder one = new StringBuilder();
        for(int i = start; i < message.length(); i++){
        
            
            if (start % 2 == 0 && i % 2 == 0){
                two.append(message.charAt(i));
                
            }
                
                
            if (start % 2 != 0 && i % 2 != 0 ){
                two.append(message.charAt(i));
                
            }
        }
        return two.toString();
    
    } 
    
    public void  simpleTests (){
        FileResource fr = new FileResource();
        
        CaesarCipherTwo cct = new CaesarCipherTwo(17,3); 
        System.out.println("Encrypted:\n"+cct.encrypt(fr.asString())+
        "Decrypted:\n"+breakCaesarCipher(fr.asString()));
        
    }
    
    public String breakCaesarCipher (String input){
        TestCaesarCipher tcc = new TestCaesarCipher();
        int key1 = tcc.breakCaesarCipher(halfOfString(input,0));
        int key2 = tcc.breakCaesarCipher(halfOfString(input,1));
        CaesarCipherTwo cct = new CaesarCipherTwo(key1,key2);
        return cct.decrypt(input);
        
    }
}
