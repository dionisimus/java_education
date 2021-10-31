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
    
    public int yearOfHighestRank(String name, String gender){
        DirectoryResource dr = new DirectoryResource();
        int currentRank = 0;
        int highestRank = 0;
        int highestYear = 0;
        for (File f : dr.selectedFiles()){
            FileResource fr = new FileResource(f);
            String path = f.getName();
            String year = path.replaceAll("[^0-9]+", "");
            CSVParser parser = fr.getCSVParser(false);
            currentRank = getRankNoFR(parser, gender, name);
            if (highestRank == 0){
            highestRank = getRankNoFR(parser, gender, name);
            highestYear = Integer.parseInt(year);
            }
            
            if (currentRank < highestRank){
            highestRank = currentRank;
            highestYear = Integer.parseInt(year);
            }
        }
        
        return highestYear;
    }
    
    public int getRankNoFR (CSVParser parser, String gender, 
                              String name) {
        int returnCount = 0;
        int genderCount = 0;
        for (CSVRecord data : parser){
            String nameRow = data.get(0);
            String genderRow = data.get(1);
            
            if (genderRow.equals(gender))
                genderCount++;
            if (nameRow.equals(name) && genderRow.contains(gender)){
                //if no name in file return -1
                returnCount = genderCount;
            }
            }
             if (returnCount != 0)
            return returnCount;
        else 
            return -1;
    }
    
    //returns a double representing the average rank of the name 
    //and gender over the selected files
    
    public double getAverageRank (String name, String gender){
        DirectoryResource dr = new DirectoryResource();
        int totalRank = 0;
        int totalFiles = 0;
        
        for (File f : dr.selectedFiles()){
            FileResource fr = new FileResource(f);
            CSVParser parser = fr.getCSVParser(false);
            totalRank = totalRank + getRankNoFR(parser, gender, name);
            totalFiles++;
        } 
        if (totalRank == 0)
            return -1.0;
        double averageRank = totalRank/totalFiles;
        return averageRank;
    }   
    
    public int getTotalBirthsRankedHigher (int year, String name, 
                                           String gender){                                  
        int genderCount = 0;
        int nameRank = 0;
        int totalBirthAbove = 0;
        FileResource fr = new FileResource();
        CSVParser parser = fr.getCSVParser(false);
        for (CSVRecord data : parser){
            String nameRow = data.get(0);
            String genderRow = data.get(1);
            String birthRow = data.get(2);
            if (nameRow.equals(name) && genderRow.contains(gender)){
                //if no name in file return -1
                break;
            }
            if (genderRow.equals(gender)){
                genderCount++;
                totalBirthAbove = totalBirthAbove + Integer.parseInt
                (birthRow);
            }
            
        }
        return totalBirthAbove;
        }    
        
    }


