import edu.duke.*;



public class Part1
{
    
    public int findStopCodon (String  dna, int startIndex, String stopCodon) {
        // put your code here
        int v = dna.indexOf(stopCodon,startIndex);
        int r;
            if (v != -1 && v % 3 == 0 ){
            r = v;
            //System.out.println("Found, Index = "+r);
        }
        else { 
            r = -1;
            //System.out.println("Not found, length = "+r);
        }
        
        return r;
    }
    

    public String findGene(String dna, int Start) {
        int startIndex = dna.indexOf("ATG",Start);
        if(startIndex == -1) {
            return "";
        }

        int taaIndex = findStopCodon(dna, startIndex, "TAA");
        int tagIndex = findStopCodon(dna, startIndex, "TAG");
        int tgaIndex = findStopCodon(dna, startIndex, "TGA");

        int minIndex = 0;
        if(taaIndex == -1 || (tagIndex != -1 && tagIndex < taaIndex)) {
            minIndex = tagIndex;
        } else {
            minIndex = taaIndex;
        }

        if(minIndex == -1 || (tgaIndex != -1 && tgaIndex < minIndex)) {
            minIndex = tgaIndex;
        }

        if(minIndex == -1) {
            return "";
        }

        return dna.substring(startIndex, minIndex + 3);
    }    

    
        
    public StorageResource getAllGenes (String dna){
        StorageResource geneList = new StorageResource();   
        
        int Start = 0;
        

        while (true){
            String Gene = findGene(dna,Start);
            if (Gene.isEmpty()){
                break;
            }
            
            geneList.add(Gene);
            Start = dna.indexOf(Gene, Start) + Gene.length();
            }
              
        return geneList;      
    }

}
        
