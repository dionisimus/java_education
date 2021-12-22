import edu.duke.*;
import java.util.*;

public class GladLib {
    private HashMap<String,ArrayList> wordsList;
    
    private ArrayList<String> adjectiveList;
    private ArrayList<String> nounList;
    private ArrayList<String> colorList;
    private ArrayList<String> countryList;
    private ArrayList<String> nameList;
    private ArrayList<String> animalList;
    private ArrayList<String> timeList;
    private ArrayList<String> verbList;
    private ArrayList<String> fruitList;
    
    
    private Random myRandom;
    
    private static String dataSourceURL = "http://dukelearntoprogram.com/course3/data";
    private static String dataSourceDirectory = "data";
    
    public GladLib(){
 
        
        initializeFromSource(dataSourceDirectory);
        myRandom = new Random();
    }
    
    
    public GladLib(String source){
        initializeFromSource(source);
        myRandom = new Random();
    }
    

    
    public void initializeFromSource(String source) {
        wordsList = new HashMap<String,ArrayList>();
        adjectiveList = readIt(source+"/adjective.txt");    
        nounList = readIt(source+"/noun.txt");
        colorList = readIt(source+"/color.txt");
        countryList = readIt(source+"/country.txt");
        nameList = readIt(source+"/name.txt");        
        animalList = readIt(source+"/animal.txt");
        timeList = readIt(source+"/timeframe.txt");  
        verbList = readIt(source+"/verb.txt");
        fruitList = readIt(source+"/fruit.txt");
        
        
        wordsList.put("adjective",adjectiveList);
        wordsList.put("noun",nounList);
        wordsList.put("color",colorList);
        wordsList.put("country",countryList);
        wordsList.put("name",nameList);
        wordsList.put("animal",animalList);
        wordsList.put("timeframe",timeList);
        wordsList.put("verb",verbList);
        wordsList.put("fruit",fruitList);
        
    }
    
    private String randomFrom(ArrayList<String> source){
        int index = myRandom.nextInt(source.size());
        return source.get(index);
    }
    
    public String getSubstitute(String label) {
        System.out.println();
        for (String word : wordsList.keySet()){
            if (word.equals(label)){
                return randomFrom(wordsList.get(word));
            }
        }      
            if (label.equals("number")){
                return Integer.toString(myRandom.nextInt(50)+5);
            }
        return "null";
        
    }
    
    private String processWord(String w){
        int first = w.indexOf("<");
        int last = w.indexOf(">",first);
        if (first == -1 || last == -1){
            
            return w;
            
        }
        String prefix = w.substring(0,first);
        String suffix = w.substring(last+1);
        String sub = getSubstitute(w.substring(first+1,last));
        return prefix+sub+suffix;
    }
    
    private void printOut(String s, int lineWidth){
        int charsWritten = 0;
        for(String w : s.split("\\s+")){
            if (charsWritten + w.length() > lineWidth){
                System.out.println();
                charsWritten = 0;
            }
            System.out.print(w+" ");
            charsWritten += w.length() + 1;
        }
    }
    
    private String fromTemplate(String source){
        String story = "";
        if (source.startsWith("http")) {
            URLResource resource = new URLResource(source);
            for(String word : resource.words()){
                story = story + processWord(word) + " ";
            }
        }
        else {
            FileResource resource = new FileResource(source);
            for(String word : resource.words()){
                story = story + processWord(word) + " ";
                
            }
        }
        return story;
    }
    
    private ArrayList<String> readIt(String source){
        ArrayList<String> list = new ArrayList<String>();
        if (source.startsWith("http")) {
            URLResource resource = new URLResource(source);
            for(String line : resource.lines()){
                list.add(line);
            }
        }
        else {
            FileResource resource = new FileResource(source);
            for(String line : resource.lines()){
                list.add(line);
            }
        }
        return list;
    }
    
    public void makeStory(){
        System.out.println("\n");
        String story = fromTemplate("data/madtemplate.txt");
        System.out.println(story);
        printOut(story, 60);
    }
    
    private int totalWordsInMap (){
        int size = 0;
        for (ArrayList value : wordsList.values()){
            size = size + value.size();
        }
        return size;
    }


}
