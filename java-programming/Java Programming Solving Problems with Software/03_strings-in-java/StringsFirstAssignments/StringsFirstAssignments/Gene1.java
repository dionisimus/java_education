
/**
 * Write a description of class Part1 here.
 *
 * @author (your name)
 * @version (a version number or a date)
 */
public class Gene1
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
    public String findSimpleGene (String dna)
    {
        // put your code here
        int ATGpos = dna.indexOf("ATG");
        if (ATGpos == -1){
            return "";
        }
        
        int TAApos = dna.indexOf("TAA", ATGpos + 3);
        if (TAApos == -1){
            return "";
        }
        
        if ((ATGpos - TAApos) % 3 == 0){
            String Gene = dna.substring(ATGpos,TAApos + 3);
            System.out.println("Gene is " + Gene);
            return Gene;
        }
        else {
            return "";
        }
    }
    
    public void testSimpleGene ()
    {
        
        findSimpleGene("ATxxxyyyTAA");
        findSimpleGene("ATGxxxyyyTAB");
        findSimpleGene("AKGxxxyyyTAB");
        findSimpleGene("ATGxxxyyyTAA");
        findSimpleGene("ATGxxxyyTAA");
        
    }   
}

        