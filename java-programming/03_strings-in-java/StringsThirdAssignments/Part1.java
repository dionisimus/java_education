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
    
    
    
    public String findGene (String dna, int Start){
       
       int l = dna.indexOf("ATG", Start);
       String result = "";
       String resultA = "";
       String resultB = "";
       String resultC = "";
       String Gene = "";
       int low = -1;
       
       if (l != -1){
        
           int a = findStopCodon(dna, l, "TAA");
           int b = findStopCodon(dna, l, "TAG");
           int c = findStopCodon(dna, l, "TGA");
           

           if(a != -1 && a<b && a<c)
           low = a;
           else if (b != -1 && b<c)
           low = b;
           else if (c != -1)
           low = c;
           else 
           return "";
        
        }
        
       if (low == -1)
           return "";
       else
           return dna.substring(l,low+3);
       
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
