import org.apache.commons.csv.*;
import edu.duke.*;
import java.lang.*;

public class Part1
{
    public void tester ()
    {
       FileResource fr = new FileResource();
       CSVParser parser = fr.getCSVParser();
       //countryInfo(parser, "Germany");
       bigExporters(parser, "$999,999,999");
    }
    
    public String countryInfo (CSVParser parser, String country){
    String info = "NOT FOUND";
        for (CSVRecord data : parser ){
           String countryField = data.get("Country");
           if (countryField.contains(country))
               info = (country + ": " + data.get("Exports") + ": " + data.get("Value (dollars)"));
        }
    return info;
    }
    
    public void listExportersTwoProducts (CSVParser parser, String exportItem1, 
                                         String exportItem2){
        for (CSVRecord data : parser ){
            String exportField = data.get("Exports");
            String countryField = data.get("Country");
            if (exportField.contains(exportItem1) && exportField.contains(exportItem2))
            System.out.println(countryField);
        }
    }
    
    public int numberOfExporters (CSVParser parser, String exportItem){
        int num = 0;
        for (CSVRecord data : parser ){
            String exportField = data.get("Exports");
            if (exportField.contains(exportItem))
            num++;
        }
        return num;
    }
    
    public String bigExporters (CSVParser parser, String amount){
        amount = amount.replaceAll("(\\$|,)",""); 
        long amountINT = Integer.parseInt(amount);
        
        for (CSVRecord data : parser ){
        String countryField = data.get("Country");
        String valueField = data.get("Value (dollars)");
        String Redacted = valueField.replaceAll("(\\$|,)","");  
        
        long IntVal = Long.parseLong(Redacted);
        if (IntVal >  amountINT)
        System.out.println(countryField + " " + valueField);
        }
        return "";
    }
}
