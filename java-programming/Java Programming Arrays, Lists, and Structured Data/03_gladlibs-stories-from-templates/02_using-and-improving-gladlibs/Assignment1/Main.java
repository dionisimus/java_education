import java.util.*;
import edu.duke.*;


public class Main
{
    // instance variables - replace the example below with your own
    private HashMap<String,Integer> codonMaps;

    /**
     * Constructor for objects of class Codons
     */
    public Main()
    {
        // initialise instance variables
        codonMaps = new HashMap<String,Integer>();
    }

    
    public void buildCodonMap(int start, String dna)
    {

        // put your code here
        codonMaps.clear();
        int length = dna.length();
        for (int i=start;i<length;i=i+3){
            
            if (i+3>length){
                break;
            }
            String codon = dna.substring(i,i+3);
            if (!codonMaps.containsKey(codon)){
                codonMaps.put(codon,1);
            }
            else{
                int oldval = codonMaps.get(codon);
                codonMaps.put(codon,oldval+1);
            }
            
        }
        System.out.println(codonMaps);
    }
    
    public String getMostCommonCodon(){
        int max = 0;
        for (int i : codonMaps.values()){
            if (i > max)
            max = i;
        }
        
        for (String key:codonMaps.keySet()){
            int maxVal = codonMaps.get(key);
            if (maxVal == max){
                return key;
            }
            
        }
        return "";
    }
    public void printCodonCounts(int start, int end){
        for (String key:codonMaps.keySet()){
            int val = codonMaps.get(key);
            if (start<val||val<end){
                System.out.println(key);
            }
            
        }
    }
    public void tester (int start, int end){
        FileResource fr = new FileResource();
        String dna = fr.asString().toUpperCase();
        for(int i=0;i<3;i++){
            buildCodonMap(i,dna);
            for (String key : codonMaps.keySet()){
                System.out.println(key);
            }
            System.out.println("Most common: "+getMostCommonCodon()+" i "+codonMaps.get(getMostCommonCodon()));
            printCodonCounts(start,end);
        }

    }
}
