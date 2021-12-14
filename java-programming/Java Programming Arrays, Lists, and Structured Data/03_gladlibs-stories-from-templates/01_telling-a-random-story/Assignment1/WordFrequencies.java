import java.util.ArrayList;
import edu.duke.*;

public class WordFrequencies
{
    // instance variables - replace the example below with your own
    private ArrayList <String> myWords;
    private ArrayList <Integer> myFreqs;

    /**
     * Constructor for objects of class WordFrequencies
     */
    public WordFrequencies()
    {
        // initialise instance variables
        myWords = new ArrayList<String>();
        myFreqs = new ArrayList<Integer>();
    }

    public void findUnique ()
    {
        // put your code here
        myWords.clear();
        myFreqs.clear();
        FileResource fr = new FileResource();
        for (String word : fr.words()){
            
            int index = myWords.indexOf(word.toLowerCase());
            if (index == -1){
                myWords.add(word.toLowerCase());
                myFreqs.add(1);
            }
            else{
                myFreqs.set(index,myFreqs.get(index)+1);
            }
        }
    }
    
    public void tester() {
        findUnique();
        System.out.println("Unique: "+myWords.size()+"\nMaxCount: "+findIndexOfMax());
        for (int i=0; i < myWords.size(); i++){
            System.out.println(myFreqs.get(i)+"\t"+myWords.get(i));
        }
    }
    
    public int findIndexOfMax(){
        int max = 0;
        for (int i=0; i < myFreqs.size(); i++){
            if(myFreqs.get(i) > max){
                max = myFreqs.get(i);
            }
        }
        return max;
    }
}
