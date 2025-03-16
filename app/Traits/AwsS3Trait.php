<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

trait AwsS3Trait
{
    # Get S3 Client Object
    protected static function getS3Client()
    {
        return new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    # Generate Presigned Url
    public static function generatePresignedUrl($fileName)
    {
        $s3 = self::getS3Client();
        $cmd = $s3->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $fileName,
            'ACL' => 'public-read', // Adjust ACL as needed
        ]);
        $presignedUrl = $s3->createPresignedRequest($cmd, env('AWS_URL_EXPIRATION_TIME'))->getUri();
        return (string) $presignedUrl;
    }    

    # Upload File
    public static function uploadFileToAwsS3($request)
    {
        $folder = 'upload';
        $fileName = 'File-' . time() . '.' . $request->file->extension();
        $filePath = $folder . '/' . $fileName;
        Storage::disk('s3')->put($filePath, file_get_contents($request->file));        
        return $filePath;       
    }

}
