
/**
 * Write a description of class Part1 here.
 *
 * @author (your name)
 * @version (a version number or a date)
 */
public class Gene2
{
       /**
     * Finds the index position of the start codon “ATG”. 
     * If there is no “ATG”, return the empty string.
     * Finds the index position of the first stop codon 
     * “TAA” appearing after the “ATG” that was found. 
     * If there is no such “TAA”, return the empty string.
     * If the length of the substring between the “ATG” 
     * and “TAA” is a multiple of 3, then return 
     * the substring that starts with that “ATG” 
     * and ends with that “TAA”
     */
    public String findSimpleGene (String dna, String startCodon, 
                                 String stopCodon)
    {
        // put your code here
        if (dna.startsWith("A")){
            dna = dna.toUpperCase();
            startCodon = startCodon.toUpperCase();
            stopCodon = stopCodon.toUpperCase();
        }
        else if (dna.startsWith("a")) {
            dna = dna.toLowerCase();
            startCodon = startCodon.toLowerCase();
            stopCodon = stopCodon.toLowerCase();
        }
        
        int start = dna.indexOf(startCodon);
        if (start == -1){
            return "";
        }
        
        int stop = dna.indexOf(stopCodon, start + 3);
        if (stop == -1){
            return "";
        }
        
        if ((start - stop) % 3 == 0){
            String Gene = dna.substring(start,stop + 3);
            if (startCodon.startsWith("A")){
                System.out.println("Gene is " + Gene);
            }
            else if(startCodon.startsWith("a")){
                System.out.println("Gene is " + Gene);
            }
            return Gene;
        }
        else {
            return "";
        }
    }
    
    public void testSimpleGene ()
    {
        
        findSimpleGene("ATxxxyyyTAA","ATG","TAA");
        findSimpleGene("ATGxxxyyyTAB","ATG","TAA");
        findSimpleGene("AKGxxxyyyTAB","ATG","TAA");
        findSimpleGene("ATGxxxzzzTAA","ATG","TAA");
        findSimpleGene("ATGxxxyyTAA","ATG","TAA");
        
    }   
}

        