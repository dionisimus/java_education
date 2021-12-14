import java.util.ArrayList;
import edu.duke.*;

public class CharactersInPlay
{
    // instance variables - replace the example below with your own
    private ArrayList<String> names = new ArrayList<String>();
    private ArrayList<Integer> counts = new ArrayList<Integer>();
    

    public void update(String person)
    {
        // put your code here
        int indexChar = names.indexOf(person.toUpperCase());
        if (names.contains(person)){
            counts.set(indexChar,counts.get(indexChar)+1);
        }
        else {
            names.add(person.toUpperCase());
            counts.add(1);
        }
    }
    public void findAllCharacters (){
        FileResource fr = new FileResource();
        names.clear();
        counts.clear();
        for (String line : fr.lines()) {
            if (line.indexOf(".") != -1){
                update(line.substring(0,line.toUpperCase().indexOf(".")));                
                }
        }
    }
    public void tester(){
         findAllCharacters();
         for (int i=0;i<names.size();i++){
             if (counts.get(i)>1){
                 System.out.println(names.get(i)+"\t"+counts.get(i));
             }
             
         }
         charactersWithNumParts(1,3);
    }
    public void  charactersWithNumParts(int num1, int num2){
        for (int i=0;i<names.size();i++){
            if (num2 > counts.get(i) && counts.get(i) > num1){
            System.out.println("NumParts:\n"+names.get(i));
            }
        }
    }
    }

