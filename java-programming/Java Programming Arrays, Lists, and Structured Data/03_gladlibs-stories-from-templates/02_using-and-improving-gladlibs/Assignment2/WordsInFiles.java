import java.util.*;
import java.io.*;
import edu.duke.*;


public class WordsInFiles
{
    // instance variables - replace the example below with your own
    private HashMap<String,ArrayList> totalWords;


    /**
     * Constructor for objects of class WordsInFiles
     */
    public WordsInFiles()
    {
        // initialise instance variables
        totalWords = new HashMap<String,ArrayList>();

    }

    
    private void addWordsFromFile(File f)
    {
        // put your code here
        FileResource fr = new FileResource(f);
        for (String word : fr.words()){
            
            if (!totalWords.containsKey(word)){
                totalWords.put(word,new ArrayList<String>());
                
            }
            else{
                
            }
            totalWords.get(word).add(f.getName());
        }
        
    }
    public void  buildWordFileMap(){
        totalWords.clear();
      
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()){
            addWordsFromFile(f);
        }
        
    }
    public int maxNumber(){
        int max = 0;
        for (ArrayList i:totalWords.values()){         
            for (int c=0;c<i.size();c++){
                i.get(c);
                for (int c2=i+1;c2<totalWords.size();c2++){
                    
                }
            }
            if (i.size()>max)
            max = i.size();
        }
        return max;
    }
    public void  printFilesIn(String word){
        ArrayList value = totalWords.get(word);
        for (int i=0;i<value.size();i++){
            System.out.println(value.get(i));
        }
    }
    public void  tester(){
        buildWordFileMap();
    }
}
