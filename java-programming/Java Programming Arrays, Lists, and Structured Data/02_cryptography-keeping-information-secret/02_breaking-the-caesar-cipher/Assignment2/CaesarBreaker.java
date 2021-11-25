
public class CaesarBreaker
{

    public String decrypt(String encrypted) {
        CaesarCipher cc = new CaesarCipher();
        int[] freqs = countLetters(encrypted);
        int maxDex = maxIndex(freqs);
        int dkey = maxDex - 4;
        
        if (maxDex < 4) {
            dkey = 26 - (4 - maxDex);
        }
        
        return cc.encrypt(encrypted, 26 - dkey);
    }
    
    
    public int[] countLetters(String encrypted) {
        int[] counts = new int[26];
        String alphabet = "abcdefghijklmnopqrstuvwxyz";
        
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
    
    public void testDecrypt (String encryptedMessage){
        CaesarCipher ccTest = new CaesarCipher();
        String encr = ccTest.encrypt(encryptedMessage, 3);
        System.out.println(encr);
        System.out.println(decrypt(encr));
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
    
    public int getKey(String s){
        int maxDex = maxIndex(countLetters(s));
        int dkey = maxDex - 4;
        
        if (maxDex < 4) {
            dkey = 26 - (4 - maxDex);
        }
        
        return dkey;
    }
    
    public String  decryptTwoKeys(String encrypted){
        CaesarCipher cc = new CaesarCipher();
        int key1 = getKey(halfOfString(encrypted,0)); 
        int key2 = getKey(halfOfString(encrypted,1));
        System.out.println(key1);
        System.out.println(key2);
         
        return cc.encryptTwoKeys(encrypted, 26 - key1, 26 - key2);
    }
    
}
