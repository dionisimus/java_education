import edu.duke.*;
import java.io.*;

public class Part3
{

    public String findGene (String dna){
       int l = dna.indexOf("atg");
       String result = "";
       String resultA = "";
       String resultB = "";
       String resultC = "";
       
       if (l >= 0){
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
           int resA=0;
           int resB=0;
           int resC=0;
           
           
           resultA = dna.substring(l,a+3);
           resultB = dna.substring(l,b+3);
           resultC = dna.substring(l,c+3);
           if (a > 1 && b > 1 && c > 1){
               System.out.println("Gen : "+resultA);
               resA++;
               System.out.println("Gen : "+resultB);
               resB++;
               System.out.println("Gen : "+resultC);
               resC++;
           }
           else if(a > 1 && b > 1 && c == 1){
               System.out.println("Gen : "+resultA);
               resA++;
               System.out.println("Gen : "+resultB);
               resB++;
               
           }
           else if(a > 1 && b == 1 && c == 1){
               System.out.println("Gen : "+resultA);
               resA++;
               
               
           }
           else if(a == 1 && b > 1 && c == 1){
               System.out.println("Gen : "+resultB);
               resB++;
               
               
           }  
           else if(a == 1 && b == 1 && c > 1){
               
               System.out.println("Gen : "+resultC);
               resC++;
               
           } 
           else if(a > 1 && b == 1 && c > 1){
               System.out.println("Gen : "+resultA);
               resA++;
               System.out.println("Gen : "+resultC);
               resC++;
           } 
           else if(a == 1 && b > 1 && c > 1){
               System.out.println("Gen : "+resultB);
               resB++;
               System.out.println("Gen : "+resultC);
               resC++;
               } 
           else
           System.out.println("Gen not found"); 
       }else
        System.out.println("Gen not found"); 
        
        return result;      
    }
    
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
    
    public void FindStopCodon (){
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()){
        FileResource fr = new FileResource(f);
        for (String line : fr.lines()) {
        // System.out.println(line);    
        //int l = line.indexOf("atg");
        // “TAA”, “TAG”, or “TGA”
        findGene(line);
        }
    }
    }
    
    public int countGenes (String dna){
        FindStopCodon();
        return 0; 
    }
}


