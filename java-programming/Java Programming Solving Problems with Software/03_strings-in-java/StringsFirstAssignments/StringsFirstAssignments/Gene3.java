import edu.duke.*;
/**
 * Write a description of class Gene3 here.
 *
 * @author (your name)
 * @version (a version number or a date)
 */
public class Gene3
{
    public String twoOccurrences (String stringa, String stringb)
    {
        // put your code here
        int f = stringb.indexOf(stringa,0);
        int f2 = stringb.indexOf(stringa,(f+stringa.length()));
        String r = "false";
        if (f != -1){
            if (f2 != -1){
                r = "true";
            }
        }
        
        return r;
    }
    
    public void testing ()
    {
        String a = twoOccurrences("t","Test string to search");
        String b = twoOccurrences("of","One of exmaples of searches");
        String c = twoOccurrences("No","No string found there");
        System.out.println("1:"+a);
        System.out.println("2:"+b);
        System.out.println("3:"+c);
        
        String a1 = lastPart("Test","Test string to search");
        String b2 = lastPart("of","One of exmaples of searches");
        String c3 = lastPart("no","No string found there");
        
        System.out.println("The part of the string after \"Test\" is " + a1);
        System.out.println("The part of the string after \"One of\" is " + b2);
        System.out.println("The part of the string after \"No\" is " + c3);
    }
    
    
    public String lastPart (String stringa, String stringb) 
    {
       int f = stringb.indexOf(stringa,0); 
       String r;
        if (f == -1){
            r = stringb;
        }
        else {
            r = stringb.substring(f+stringa.length());
        }
       return r; 
    }
}
