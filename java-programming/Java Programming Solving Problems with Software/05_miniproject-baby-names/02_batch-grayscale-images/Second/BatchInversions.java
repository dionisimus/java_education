import edu.duke.*;
import java.io.File;

public class  BatchInversions 
{
    public void selectAndConvert (){
        DirectoryResource dr = new DirectoryResource();
        for (File f : dr.selectedFiles()){
            ImageResource originalImage = new ImageResource(f);
            ImageResource negativeImage = makeInversion(originalImage);
            negativeImage.draw();
            negativeImage.setFileName("negative-" + 
            originalImage.getFileName());
            negativeImage.save();
        }
    }
    
    public ImageResource makeInversion (ImageResource original)
    {
        ImageResource negativeImage = new ImageResource(original.getWidth(),
        original.getHeight());
        for (Pixel p : negativeImage.pixels()){
            Pixel originalP = original.getPixel(p.getX(),p.getY());
            p.setRed(255 - originalP.getRed()); 
            p.setGreen(255 - originalP.getGreen());
            p.setBlue(255-originalP.getBlue());
        }
        return negativeImage;
    }
}
