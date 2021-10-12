import edu.duke.*;
import java.io.File;


public class Part4
{
    public void main(){
    int q1;
    int q2;
    String r;
    URLResource ur = new URLResource("https://www.dukelearntoprogram.com//course2/data/manylinks.html");
    for (String s : ur.words())
    {
        String low = s.toLowerCase();
        if (low.indexOf("youtube.com") != -1){
            q1 = low.indexOf("\"");
            if (q1 != -1);{
                q2 = low.indexOf("\"",(q1+1));
                if (q2 != -1);{
                    r = s.substring((q1+1),q2);
                    System.out.println(r);
                }
            }
        }
    }
    
    }
}