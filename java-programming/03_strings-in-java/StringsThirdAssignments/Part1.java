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
    
<<<<<<< HEAD
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
=======
    
    
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
    
>>>>>>> 694bc52aaa733df7150d0f44a9aa041c234a2892
    
    
    public StorageResource getAllGenes (String dna){
        StorageResource geneList = new StorageResource();   
        
        int Start = 0;
        
<<<<<<< HEAD
=======
        
>>>>>>> 694bc52aaa733df7150d0f44a9aa041c234a2892
        while (true){
            String Gene = findGene(dna,Start);
            if (Gene.isEmpty()){
                break;
            }
<<<<<<< HEAD
            
            geneList.add(Gene);
            Start = dna.indexOf(Gene, Start) + Gene.length();
            }
              
        return geneList;      
    }

}
=======
        
            geneList.add(Gene);
            Start = dna.indexOf(Gene, Start) + Gene.length();
            }
        
        
        
        
               
        return geneList;      
    }

}
>>>>>>> 694bc52aaa733df7150d0f44a9aa041c234a2892
