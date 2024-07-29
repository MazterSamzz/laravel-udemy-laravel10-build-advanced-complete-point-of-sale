<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     *  Create a folder if it doesn't exist.
     *  @param string Folder path, example: 'upload/portfolio'
     *  @return void
     */
    public static function hasFolder($path): void
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }

    /**
     *  Save image to $path
     *  @param mixed $file File uploaded by user, example: $request->file('image')
     *  @param string $destinationFolder Save image to this Folder, example: 'upload/portfolio'
     *  @return string Return image path, example: 'upload/portfolio/nama_file.jpg'
     */
    public static function saveImage($file, $destinationFolder = 'images'): string
    {
        self::hasFolder($destinationFolder);

        $fileName = Str::uuid()->toString() . $file->getClientOriginalExtension();
        $file->move($destinationFolder, $fileName);

        return $destinationFolder . '/' . $fileName;
    }

    /**
     *  Move Unused Image to 'recycle bin', example: 'upload/portfolio/nama_file.jpg'
     *  to 'recycle bin/upload/portfolio/$filterBy/namafile.jpg'
     *  @param string $sourcePath Unused Image Path example: 'upload/portfolio/nama_file.jpg'
     *  @param string $filterBy Filter deleted image by, example: $username
     *  @return void 
     */
    public static function softDelete($sourcePath, $filterBy = ''): void
    {
        $imgDir = dirname($sourcePath); // dirname($sourcePath) // Output: upload/portfolio
        $imgName = basename($sourcePath); // basename($sourcePath) // Output: nama_file.jpg
        $imgDir = $filterBy ? $imgDir . '/' : $imgDir;

        $destinationPath =  'recycle bin/' . $imgDir . $filterBy . '/' . $imgName;

        // If file exist, Move the file to destinationFolder
        if (File::exists($sourcePath)) {
            // Create Folder if the folder not exist
            self::hasFolder('recycle bin/' . $imgDir . $filterBy);
            // move file from $sourcePath to $destinationPath
            File::move($sourcePath, $destinationPath);
        }
    } // end of moveFile
}
