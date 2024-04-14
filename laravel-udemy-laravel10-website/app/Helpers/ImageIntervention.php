<?php
namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Facades\File;

class ImageIntervention {
    // Save $file to $path and Resize to $width and $height
    public static function saveRezisedImage($file, $path, $width=300, $height=300) {
        // create save_url (image path as string)
        $image = $file;
        $save_url = $path.hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        self::hasFolder($path);

        // Image Intervention Resize to $width and $height then upload image
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);
        $img = $img->resize($width, $height)->save($save_url);

        // return image path as string
        return $save_url;
    } // end of saveResizedImage

    // move $filePath = 'upload/portfolio/nama_file.jpg'
    // to 'upload/portfolio/$newSubFolder/namafile.jpg'
    public static function moveFile($filePath, $newSubFolder='bin')
    {
        $imgDir = dirname($filePath); // dirname($filePath) // Output: upload/portfolio
        $imgName = basename($filePath); // basename($filePath) // Output: nama_file.jpg

        $sourcePath = $filePath;
        $destinationPath = $imgDir. '/' . $newSubFolder . '/' . $imgName;

        

        // If file exist, Move the file to the new folder
        if (File::exists($sourcePath)) {

            // Create Folder if the folder not exist
            self::hasFolder($imgDir.'/'.$newSubFolder);

            // move file from $sourcePath to $destinationPath
            File::move($sourcePath, $destinationPath);
            // dd("File moved successfully from " . $sourcePath . " to: " . $destinationPath);

        } else {
            return($sourcePath." file not found.");
        }
    } // end of moveFile

    private static function hasFolder($path) {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }
}