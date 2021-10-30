import edu.duke.*;
import java.io.*;

public class Part1
{
    public void sampleMethod()
    {
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()){
            ImageResource image = new ImageResource(f);
            ImageResource newImage = grayScale(image);
            String oldName = image.getFileName();
            saver(oldName, newImage);
           
        }
    }
    
    public void saver(String oldName, ImageResource newImage){
        String newName = "gray-" + oldName;
        newImage.setFileName(newName);
        newImage.save();
    }
    
    public ImageResource grayScale (ImageResource image){
        
        ImageResource outImage = new ImageResource(image.getWidth(), 
                                    image.getHeight());
        for (Pixel p : outImage.pixels()){
            Pixel inImage = image.getPixel(p.getX(),p.getY());
            int average = (inImage.getRed() + inImage.getGreen() + 
            inImage.getBlue())/3;
            p.setRed(average);
            p.setGreen(average);
            p.setBlue(average);
        }
        return outImage;
    }
}

