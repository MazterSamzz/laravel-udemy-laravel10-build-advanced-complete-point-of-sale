<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
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
     *  @param mixed $image Image file uploaded by user, example: $request->file('image')
     *  @param string $destinationFolder Save image to this Folder, example: 'upload/portfolio'
     *  @return string Return image path, example: 'upload/portfolio/nama_file.jpg'
     */
    public static function saveImage($image, $destinationFolder = 'images', $width = 300, $height = 300): string
    {
        self::hasFolder($destinationFolder);

        $imageName = $destinationFolder . '/' . Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();

        // Image Intervention Resize to $width and $height then upload image
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);
        $img = $img->resize($width, $height)->save($imageName);

        return $imageName;
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



    /**
     *  Get a random image from the specified folder and simulate an upload to the database.
     *  The image path will be saved in the database as a relative path.
     *  If no images are found, an empty string will be returned.
     *
     *  @param string $imagePath Path to the folder containing the images, example: public_path('sample/product-images')
     *  @param string $savePath The path to save the image, example: public_path('images/product-image')
     *  @param int $width The width of the image.
     *  @param int $height The height of the image.
     *  @return string The relative path to the uploaded image.
     */
    public static function getRandomImage($imagePath, $savePath, $width = 300, $height = 300): string
    {
        // Ambil semua file gambar dalam folder
        $files = glob($imagePath . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);

        // Cek apakah ada file gambar
        if (count($files) === 0) {
            return null; // Kembalikan null jika tidak ada gambar
        }

        // Pilih gambar secara acak
        $randomImage = $files[array_rand($files)];

        // Simulasikan upload file menggunakan UploadedFile
        $uploadedFile = new UploadedFile($randomImage, basename($randomImage));

        // Kembalikan path relatif untuk disimpan di database
        return self::saveImage($uploadedFile, $savePath, $width, $height);
    }
}
