import edu.duke.*;
import java.io.File;


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
            r = 1;
            //System.out.println("Not found, length = "+r);
        }
    
        return r;
    }
    
    public void testFindStopCodon (){
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()){
        FileResource fr = new FileResource(f);
        for (String line : fr.lines()) {
        // System.out.println(line);    
        //int l = line.indexOf("atg");
        // “TAA”, “TAG”, or “TGA”
        printAllGenes(line);      
        }
    }
    }
    public String findGene (String dna){
       int l = dna.indexOf("atg");
       String result = "";
       String resultA = "";
       String resultB = "";
       String resultC = "";
       
       if (l >= 0){
           
       
       
           int comp = 0;
           
           int a = findStopCodon(dna, l, "taa");
           int b = findStopCodon(dna, l, "tag");
           int c = findStopCodon(dna, l, "tga");
           int low = 0;
           //System.out.println(a);
           //System.out.println(b);
           //System.out.println(c);
           // if(a<b && a<c)
           // low = a;
           // else if (b<c)
           // low = b;
           // else 
           // low = c;
           
           resultA = dna.substring(l,a+3);
           resultB = dna.substring(l,b+3);
           resultC = dna.substring(l,c+3);
           if (a > 1 && b > 1 && c > 1){
               System.out.println("Gen : "+resultA);
               System.out.println("Gen : "+resultB);
               System.out.println("Gen : "+resultC);
           }
           else if(a > 1 && b > 1 && c == 1){
               System.out.println("Gen : "+resultA);
               System.out.println("Gen : "+resultB);
               
           }
           else if(a > 1 && b == 1 && c == 1){
               System.out.println("Gen : "+resultA);
               
               
           }
           else if(a == 1 && b > 1 && c == 1){
               System.out.println("Gen : "+resultB);
               
               
           }  
           else if(a == 1 && b == 1 && c > 1){
               
               System.out.println("Gen : "+resultC);
               
           } 
           else if(a > 1 && b == 1 && c > 1){
               System.out.println("Gen : "+resultA);
               System.out.println("Gen : "+resultC);
               
           } 
           else if(a == 1 && b > 1 && c > 1){
               System.out.println("Gen : "+resultB);
               System.out.println("Gen : "+resultC);
               
           } 
           else
           System.out.println("Gen not found"); 
       }else
        System.out.println("Gen not found"); 
        
        return result;      
    }
    
    public void testFindGene (){
        String no1 = "zzzxxxyyytaa";
        String yes1 = "atgxxxyyytaa";
        String yes2 = "atgxxxyyytaaxxxtag";
        String no2 = "atgxxxyyytax";
        String yes3 = "atgxxxyyytag";
        
        System.out.println("no "+ no1);
        findGene(no1);
        System.out.println("yes "+yes1);
        findGene(yes1);
        System.out.println("yes "+yes2);
        findGene(yes2);
        System.out.println("no "+no2);
        findGene(no2);
        System.out.println("yes "+yes3);
        findGene(yes3);
    }
    
    
    public void printAllGenes (String dna) {
        findGene(dna);
        }
}
