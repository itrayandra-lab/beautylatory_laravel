<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FileUploadService
{
    /**
     * Upload a file to the specified directory in public/images
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string|null
     */
    public static function upload(UploadedFile $file, string $directory): ?string
    {
        // Validate file type
        $allowedMimes = ['jpeg', 'png', 'jpg', 'gif', 'webp'];
        if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif', 'webp'])) {
            if (!in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'])) {
                return null;
            }
        }

        // Validate file size (2MB max)
        if ($file->getSize() > 2 * 1024 * 1024) { // 2MB in bytes
            return null;
        }

        // Create directory if it doesn't exist
        $path = public_path("images/{$directory}");
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Generate unique filename with WebP extension
        $filename = time() . '_' . uniqid() . '.webp';
        
        // Convert image to WebP format using Intervention Image
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        
        // Encode to WebP with quality 80
        $encodedImage = $image->toWebp(80);
        
        // Save the converted image
        $encodedImage->save($path . '/' . $filename);

        // Return relative path from public directory
        return "images/{$directory}/{$filename}";
    }

    /**
     * Delete a file from public/images
     *
     * @param string|null $filePath
     * @return bool
     */
    public static function delete(?string $filePath): bool
    {
        if (!$filePath) {
            return false;
        }

        $fullPath = public_path($filePath);
        
        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    /**
     * Update a file by deleting the old one and uploading a new one
     *
     * @param UploadedFile|null $newFile
     * @param string|null $oldFilePath
     * @param string $directory
     * @return string|null
     */
    public static function update(?UploadedFile $newFile, ?string $oldFilePath, string $directory): ?string
    {
        if (!$newFile) {
            return $oldFilePath; // No new file, keep the old one
        }

        // Delete old file
        self::delete($oldFilePath);

        // Upload new file
        return self::upload($newFile, $directory);
    }
}