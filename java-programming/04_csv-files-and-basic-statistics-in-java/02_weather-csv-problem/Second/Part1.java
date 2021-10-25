import org.apache.commons.csv.*;
import edu.duke.*;

public class Part1
{
    public void testColdestHourInFile(){
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser();
        coldestHourInFile(parser);
    }
    
    
    public double coldestHourInFile(CSVParser parser)
    {
        double lowest = 0.0;
        String Time = "";
        for (CSVRecord data : parser ){
            String Temp = data.get("TemperatureF");
            double NumTempr = Double.parseDouble(Temp);
            String CurrTime = data.get("TimeEST");
            if (lowest == -9999);
            if (lowest == 0.0)
                lowest = NumTempr;
            if (NumTempr < lowest)
                lowest = NumTempr;
            Time = CurrTime;
        }
        System.out.println(Time + " " + lowest);
        return lowest;
    }
    
    
}
