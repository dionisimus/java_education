
/**
 * Write a description of class Tester here.
 * 
 * @author (your name) 
 * @version (a version number or a date)
 */

import java.util.*;
import edu.duke.*;


public class Tester
{
    public void testUniqueIP() {
         // complete method
         LogAnalyzer la = new LogAnalyzer();
         la.readFile();
         System.out.println("Unique IP`s: "+la.countUniqueIPs()+"\nLogs code higher:\n");
         la.printAllHigherThanNum(200);
         System.out.println("Unique per day:");
         la.uniqueIPVisitsOnDay("Sep 30");
         System.out.println("Unique per code:");
         la.countUniqueIPsInRange(300,399);
         System.out.println("Count visits per ip:\n"+la.countVisitsPerIP());
         System.out.println("Count visits most:\n"+la.iPsMostVisits());
    }
    
}
