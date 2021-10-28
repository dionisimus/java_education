import edu.duke.*;
import org.apache.commons.csv.*;

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
	    String returnName = "";
	    for (CSVRecord data : parser){
	    //compare gender
	    System.out.println(data.get(0) + data.get(1));
	    
                if (data.get(0) == name && data.get(1) == gender){
                    //if no name in file return -1
                    System.out.println("Found");
                    returnName = data.get(2);
                }
            }
            if (returnName != "")
                return returnName;
            else 
                return "-1";
        }
	
}

