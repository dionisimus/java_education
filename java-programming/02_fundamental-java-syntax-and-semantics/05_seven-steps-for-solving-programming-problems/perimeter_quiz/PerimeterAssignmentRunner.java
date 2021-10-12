import edu.duke.*;
import java.io.File;

public class PerimeterAssignmentRunner {
    public double getPerimeter (Shape s) {
        // Start with totalPerim = 0
        double totalPerim = 0.0;
        // Start wth prevPt = the last point 
        Point prevPt = s.getLastPoint();
        // For each point currPt in the shape,
        for (Point currPt : s.getPoints()) {
            // Find distance from prevPt point to curfrPt 
            double currDist = prevPt.distance(currPt);
            // Update totalPerim by currDist
            totalPerim = totalPerim + currDist;
            // Update prevPt to be currPt
            prevPt = currPt;
        }
        // totalPerim is the answer
        return totalPerim;
    }

    public int getNumPoints (Shape s) {
        // Put code here
        int count = 0;
         for (Point p : s.getPoints()){ 
         System.out.println(p);
         count++;
         }
        return 0;
    }

        public String getFileWithLargestPerimeter() {
        // Put code here
        File largestFile = null;    // replace this codes
        double largestPeri = 0.0;
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()) {
            FileResource fr = new FileResource(f);
            //System.out.println(f);
            Shape s = new Shape (fr);
            double peri = getPerimeter(s);
            //largestFile = f;
            //System.out.println("Perimetr="+peri+"File="+largestFile);
            if (peri > largestPeri){
                largestFile = f;
                largestPeri = peri;
            }
        }
        System.out.println("Largest perimert = "+ largestPeri
        + "\nFilename:" + largestFile);
        return null;
    }
    
    
    public double getLargestPerimeterMultipleFiles() {
           // Put code here
         double largestPeri = 0.0;
         DirectoryResource dr = new DirectoryResource();
         for (File f : dr.selectedFiles()) {
             FileResource fr = new FileResource(f);
             //System.out.println(fr);
             Shape s = new Shape (fr);   
             double peri = getPerimeter(s);
             if (peri > largestPeri)
                 largestPeri = peri;
         }
        
         System.out.println("Largest perimert = "+largestPeri);
         return largestPeri;
    }
    
        public double testPerimeter() {
        FileResource fr = new FileResource();
        Shape s = new Shape(fr);
        getNumPoints(s);
        double length = getPerimeter(s);
        double averageLength = getAverageLength(s);
        double largestSide = getLargestSide(s);
        double largestx = getLargestX(s);
        System.out.println("perimeter = " + length +
        "\naverage length = " + averageLength + 
        "\nlargest side size = " + largestSide + 
        "\nlagrestX = " + largestx );
        return length;                     
    }

    
    
    
    
    public double getAverageLength(Shape s) {
        // Put code here
        double totalLength = 0.0;
        Point prevPt = s.getLastPoint();
        int counter = 0; 
        for (Point currPt : s.getPoints()) {
            // Find distance from prevPt point to curfrPt 
            double currDist = prevPt.distance(currPt);
            // Update totalPerim by currDist
            totalLength = totalLength + currDist;
            // Update prevPt to be currPt
            prevPt = currPt;
            counter ++;
        }
        System.out.println("num of shapes:"+counter);
        double averageLength = totalLength / counter; 
        return averageLength;
    }

    public double getLargestSide(Shape s) {
        // Put code here
        double largestSide = 0.0;
        Point prevPt = s.getLastPoint();
        int counter = 0; 
        for (Point currPt : s.getPoints()) {
            // Find distance from prevPt point to curfrPt 
            double currDist = prevPt.distance(currPt);
            // Update totalPerim by currDist
            
            // Update prevPt to be currPt
            if (currDist > largestSide)
                largestSide = currDist;
            prevPt = currPt;
            counter ++;
        }
        // totalPerim is the answer
        //return totalPerim;
        return largestSide;
    }

    public double getLargestX(Shape s) {
        // Put code here
        double largestX = 0.0;
        for (Point currentPt  : s.getPoints()){
            double currentPtX = currentPt.getX();
            if(currentPtX>largestX) 
                largestX = currentPtX;
        }
        return largestX;
    }

    

    public void testPerimeterMultipleFiles() {
        // Put code here
    }

    public void testFileWithLargestPerimeter() {
        // Put code here
        getFileWithLargestPerimeter();
    }

    // This method creates a triangle that you can use to test your other methods
    public void triangle(){
        Shape triangle = new Shape();
        triangle.addPoint(new Point(0,0));
        triangle.addPoint(new Point(6,0));
        triangle.addPoint(new Point(3,6));
        for (Point p : triangle.getPoints()){
            System.out.println(p);
        }
        double peri = getPerimeter(triangle);
        System.out.println("perimeter = "+peri);
    }

    // This method prints names of all files in a chosen folder that you can use to test your other methods
    public void printFileNames() {
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()) {
            FileResource fr = new FileResource(f);
        }
    
    }

    public static void main (String[] args) {
        //PerimeterAssignmentRunner pr = new PerimeterAssignmentRunner();
        //pr.testPerimeter();
        //pr.triangle();
        
        PerimeterAssignmentRunner pr = new PerimeterAssignmentRunner();
        pr.testFileWithLargestPerimeter();
    }
}
