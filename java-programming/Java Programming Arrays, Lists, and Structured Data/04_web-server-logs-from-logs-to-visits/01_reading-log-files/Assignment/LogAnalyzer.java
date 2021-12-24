
/**
 * Write a description of class LogAnalyzer here.
 * 
 * @author (your name) 
 * @version (a version number or a date)
 */

import java.util.*;
import edu.duke.*;

public class LogAnalyzer
{
     private ArrayList<LogEntry> records;
     private HashMap<String, Integer> countVisPerIp;
     
     public LogAnalyzer() {
         // complete constructor
         records = new ArrayList<LogEntry>();
     }
        
     public void readFile() {
         // complete method
         // String filename = "short-test_log";
         String filename = "weblog3-short_log";
         FileResource fr = new FileResource(filename);
         for (String rec : fr.lines()){
             records.add(WebLogParser.parseEntry(rec));
         }
         
     }
        
     public void printAll() {
         for (LogEntry le : records) {
             System.out.println(le);
         }
     }
     
     public int countUniqueIPs(){
         ArrayList<String> unique = new ArrayList<String>();
         for (LogEntry le : records){
             if (!unique.contains(le.getIpAddress())){
                 unique.add(le.getIpAddress());
             }
         }
         return unique.size();
     }
     
     public void printAllHigherThanNum(int num){
         for (LogEntry le : records){
             if (le.getStatusCode() > num){
                 System.out.println(le);
             }
         }
     }
     
     public void uniqueIPVisitsOnDay(String someday){
         ArrayList<String> uniqueDay = new ArrayList<String>();
         for (LogEntry le : records){
             // System.out.println(le.getAccessTime().toString());
             if (le.getAccessTime().toString().contains(someday) && 
             !uniqueDay.contains(le.getIpAddress())){
                 uniqueDay.add(le.getIpAddress());
                 System.out.println(le.getIpAddress());
             }
         }
         
     }
     
     public void countUniqueIPsInRange(int low, int high){
         ArrayList<String> uniqueRange = new ArrayList<String>();
         for (LogEntry le : records){
             if (!uniqueRange.contains(le.getIpAddress()) &&
             le.getStatusCode() >= low && le.getStatusCode() <= high) {
                 uniqueRange.add(le.getIpAddress());
                 System.out.println(le.getIpAddress());
             }
         }
     }
     
     public HashMap<String, Integer> countVisitsPerIP(){
         countVisPerIp = new HashMap<String, Integer>();
         for (LogEntry le : records){
             if (!countVisPerIp.containsKey((le.getIpAddress()))) {
                 countVisPerIp.put(le.getIpAddress(),1);
                 
             }else{
                 countVisPerIp.put(le.getIpAddress(),countVisPerIp.get(le.getIpAddress())+1);
             }
         }
         return countVisPerIp;
     }
     
     public ArrayList<String> iPsMostVisits(){
         ArrayList<String> ipMostVis = new ArrayList<String>();
         int max = 0;
         for (int count : countVisPerIp.values()){
             if (count > max){
                 max = count;
             }
         }
         for (String ip : countVisPerIp.keySet()){
             if (countVisPerIp.get(ip) == max){
                 ipMostVis.add(ip);
             }
         }
         return ipMostVis;
     }
     
     public HashMap<String, ArrayList<String>> iPsForDays(){
         
         return null;
     }
}