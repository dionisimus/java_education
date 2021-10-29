import edu.duke.*;
import org.apache.commons.csv.*;
import java.io.File;

public class Part1
{
        public void totalBirths (FileResource fr) {
        int totalBirths = 0;
        int totalBoys = 0;
        int totalGirls = 0;
        int totalBoysNames = 0;
        int totalGirlsNames = 0;
        int totalNames = 0;
        int girls = 0;
        
        for (CSVRecord rec : fr.getCSVParser(false)) {
            int numBorn = Integer.parseInt(rec.get(2));
            totalBirths += numBorn;
            
            if (rec.get(1).equals("M")) {
                        totalBoys += numBorn;
                        totalBoysNames++;
            }
            else {
                    totalGirls += numBorn;
                    totalGirlsNames++;
            }
        }
        totalNames = totalBoysNames + totalGirlsNames;
        System.out.println("total births = " + totalBirths);
        System.out.println("female girls = " + totalGirls);
        System.out.println("male boys = " + totalBoys);
        System.out.println("total boys names = " + totalBoysNames);
        System.out.println("total girls names = " + totalGirlsNames);
        System.out.println("total names = " + totalNames);
    }
    
    public void testTotalBirths () {
        //FileResource fr = new FileResource();
        FileResource fr = new FileResource();
        totalBirths(fr);
    }
    
    public String getRank (int year, String name, String gender) {
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser(false);
        String returnCount = "";
        int genderCount = 0;
        
        for (CSVRecord data : parser){
            String nameRow = data.get(0);
            String genderRow = data.get(1);
            
            if (genderRow.equals(gender))
                genderCount++;
            if (nameRow.equals(name) && genderRow.contains(gender)){
                //if no name in file return -1
                returnCount = String.valueOf(genderCount);
            }
            }
        if (returnCount != "")
            return returnCount;
        else 
            return "-1";
    }
    
    public void whatIsNameInYear (String name, int year, int newYear, String gender){
        String firstRank = getRank(year, name, gender);
        
        String genderType = "she";
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser(false);
        int genderCount = 0;
        String newName = "";
        for (CSVRecord data : parser){
            String nameRow = data.get(0);
            String genderRow = data.get(1);
            String rateRow = data.get(2);
            
            if (genderRow.equals(gender))
                genderCount++;
            if (Integer.parseInt(firstRank) == genderCount && genderRow.contains(gender)){
                newName = nameRow;
            }
        }
        if (newName == "")
        newName = "No Record for this rang";
        if (gender == "M")
            genderType = "he";
 
        System.out.println(name + " born in " + year + " would be " + newName + 
        " if " + genderType + " war born in " + newYear);
    }
    
    public void yearOfHighestRank(String name, String gender){
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()){
            FileResource fr = new FileResource(f);
            CSVParser
        }
    }
}

