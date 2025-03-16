<?php

namespace App\Traits;

use App\Helpers\UrlHelper;

trait FileUploadTrait
{    
    # Upload File
    protected static function uploadFile($file, $folder = 'upload')
    {        
        $fileName = 'File-' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = UrlHelper::fileUploadPath() . '/' . $folder;
        $file->move($filePath, $fileName);
        return $fileName;
    }

    # Upload Multiple Files
    protected static function uploadFiles(array $files, $folder = 'upload')
    {
        $uploadedFiles = [];
        foreach ($files as $key => $file) {
            $fileName = 'File-' . (time()+$key) . '.' . $file->getClientOriginalExtension();
            $filePath = UrlHelper::fileUploadPath() . '/' . $folder;
            $file->move($filePath, $fileName);          
            $uploadedFiles[] = [
                "file_name" => $fileName,
                "file_url" => UrlHelper::getFilePath() . '/' . $folder . '/' . $fileName
            ];            
        }
        return $uploadedFiles;
    }
}
