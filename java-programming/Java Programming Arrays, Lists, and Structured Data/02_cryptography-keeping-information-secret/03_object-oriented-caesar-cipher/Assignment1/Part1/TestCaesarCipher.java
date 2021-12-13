import edu.duke.*;


public class TestCaesarCipher
{
    // instance variables - replace the example below with your own
    private int x;
    private String alphabet = "abcdefghijklmnopqrstuvwxyz";
    /**
     * Constructor for objects of class TestCaesarCipher
     */
    public TestCaesarCipher()
    {
        // initialise instance variables
        x = 0;
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
    
    public void simpleTests(){
        FileResource fr = new FileResource();
        String fileStr = fr.asString();
        CaesarCipher cc = new CaesarCipher(18);
        String encr = cc.encrypt(fileStr);
        String decr = cc.decrypt(encr);
        System.out.println("Encrypted: "+encr + "\n" + "Decrypted: "+decr);
        breakCaesarCipher(encr);
        }
        
    public int breakCaesarCipher(String input){
        int[] freqs = countLetters(input);
        int maxDex = maxIndex(freqs);
        int dkey = maxDex - 4;
        if (maxDex < 4) {
            dkey = 26 - (4 - maxDex);
        }
        CaesarCipher ccD = new CaesarCipher(dkey);
        return dkey;
    }
    } 

