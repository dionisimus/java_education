import edu.duke.*;
import java.io.File;

public class Part2
{
    public int howMany (String stringa, String stringb) {
        
        int R = stringb.indexOf(stringa);
        
        if (R != -1){
        int Counter = 0;
        while (R != -1){
            ++Counter;
            
            R = stringb.indexOf(stringa,R + stringa.length());
        }
        
        System.out.println(Counter);
        }
        return 0;
        };
        
       
    
    }

