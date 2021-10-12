import edu.duke.*;
import java.io.File;

public class Part2
{
    public int howMany (String stringa, String stringb) {
        
        int I = stringb.indexOf(stringa);
        System.out.println("I: " + I);
        if (I != -1){
        
        int C = 0;
            
        for (int L = stringb.indexOf(stringa); L != -1; ++C){
            L=I;
            System.out.println("C:" + C);
            
            
        }
        }
        return 0;
        };
        
       
    
    }

