<?php

namespace App\Repositories\S3;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class UploadFileRepository implements UploadFileRepositoryInterface
{
    public function upload($file){
        $fileNameWithoutSpaces = str_replace(' ','_',$file->getClientOriginalName());
        $editedFileName = time().'_'.$fileNameWithoutSpaces;
        $fileContent = $file->getContent();
        // $filenameForS3 = $path."/".$editedFileName;
        $file->move('images', $editedFileName);
        // $response = Storage::disk('s3')->put($filenameForS3, $fileContent, []);
        return $editedFileName;
    }
}
