import org.apache.commons.csv.*;
import edu.duke.*;
import java.io.File;

public class Part1
{
    public void testColdestHourInFile(){
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser();
        coldestHourInFile(parser);
    }
    
    
    public CSVRecord coldestHourInFile(CSVParser parser)
    {
        CSVRecord coldest = null;
        for (CSVRecord data : parser){
            double temp = Double.parseDouble(data.get("TemperatureF"));
            if (coldest == null && temp != -9999)
                coldest = data;
            
            if (temp < Double.parseDouble(coldest.get("TemperatureF")) && temp != -9999)
                coldest = data;
            
        }
        return coldest;
    }
    
    public File fileWithColdestTemperature(){
        DirectoryResource dr = new DirectoryResource();
        File lowestFile = null;
        double lowestTemp = 0.0;
        for (File f : dr.selectedFiles()){
            FileResource fr = new FileResource(f);
            CSVParser CSVpar = fr.getCSVParser();
            CSVRecord current = coldestHourInFile(CSVpar);
            
            
            double currTemp = Double.parseDouble(current.get("TemperatureF"));
            
            if (lowestFile == null){
                lowestFile = f;
                lowestTemp = currTemp;
            }
            if (currTemp < lowestTemp){
                lowestFile = f;
                lowestTemp = currTemp;
            }
            }
           
        return lowestFile;
    }
    
    public void  testFileWithColdestTemperature(){
            File file = fileWithColdestTemperature();
            String fileName = file.getName();
            String filePath = file.getPath();
            
            System.out.println("Coldest day was in file " + fileName);
            FileResource fr = new FileResource(filePath);
            CSVParser parser = fr.getCSVParser();
            CSVRecord coldTemp = coldestHourInFile(parser);
            
            System.out.println("Coldest temperature on that day was "  + 
            Double.parseDouble(coldTemp.get("TemperatureF")));
            System.out.println("All the Temperatures on the coldest day were:");
             for (CSVRecord tempAll : fr.getCSVParser()){
                 System.out.println(tempAll.get("TemperatureF"));
            }
            }
    
    public CSVRecord lowestHumidityInFile (CSVParser parser){
        CSVRecord humLow = null;
        for (CSVRecord data : parser){
            String humString = data.get("Humidity");
            
            
            if (humLow == null && humString != "N/A"){
                humLow = data;
                
            }
            int humINTlow = Integer.parseInt(humLow.get("Humidity"));  
            int humINTcur = Integer.parseInt(data.get("Humidity"));
            if (humINTcur < humINTlow && humString != "N/A")
                humLow = data;
        }
        return humLow;
        }
        
    public void  testLowestHumidityInFile (){
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser();
        CSVRecord csv = lowestHumidityInFile(parser);
        System.out.println("Lowest Humidity was " + csv.get("Humidity") + " " + csv.get("DateUTC"));
    }
    
    public CSVRecord lowestHumidityInManyFiles (){
        DirectoryResource dr = new DirectoryResource();
        CSVRecord lowestRec = null;
        
        for (File f : dr.selectedFiles()){
        FileResource fr = new FileResource(f);
        CSVParser data = fr.getCSVParser();
        CSVRecord currHum = lowestHumidityInFile(data);
        
        if (lowestRec == null && currHum.get("Humidity") != "N/A"){
            lowestRec = currHum;
            
        }
        int lowestHumNum = Integer.parseInt(lowestRec.get("Humidity"));
        int currHumNum =  Integer.parseInt(currHum.get("Humidity"));
        if (currHumNum < lowestHumNum && currHum.get("Humidity") != "N/A")
            lowestRec = currHum;
        }
        
        return lowestRec;
    }
    
    public void testLowestHumidityInManyFiles(){
        CSVRecord result = lowestHumidityInManyFiles();
        System.out.println("Lowest Humidity was " + result.get("Humidity") + " " +
        result.get("DateUTC"));
    }
    
    public double averageTemperatureInFile (CSVParser parser){
        double total = 0.0;
        int count = 0;
        double result = 0.0;
        for (CSVRecord record : parser){
            double currTemp = Double.parseDouble(record.get("TemperatureF"));
            total = total + currTemp;
            count++;
        }
        result = total/count;
        return result;
        }
      
    public void testAverageTemperatureInFile(){
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser();
        
        System.out.println(averageTemperatureInFile(parser));
    }
    
    public double averageTemperatureWithHighHumidityInFile(CSVParser parser, int value) {
        double total = 0.0;
        int count = 0;
        double result = 0.0;
        for (CSVRecord record : parser){
            if (record.get("Humidity") != "N/A" &&
            Integer.parseInt(record.get("Humidity")) >= value){
            double currTemp = Double.parseDouble(record.get("TemperatureF"));
            total = total + currTemp;
            count++;
            }
        }
        
        if (count == 0)
            return 0;
        else{
            result = total/count;
            return result;
        }
    }
    
    public void testAverageTemperatureWithHighHumidityInFile(){
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser();
        double result = averageTemperatureWithHighHumidityInFile(parser, 80);
        if (result == 0)
        System.out.println("No temperatures with that humidity");
        else
        System.out.println("Average Temp when high Humidity is " + result);
    }
    }

