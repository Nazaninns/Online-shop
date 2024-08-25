<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService
{
    protected $path;
    public function __construct(public UploadedFile $file)
    {
    }

    public  function upload($dir): void
    {
        if (!$this->file->isValid()) {
            throw new \InvalidArgumentException('Uploaded file is not valid.');
        }
        $fileName = $this->file->hashName();
        $this->path = $this->file->storeAs($dir, $fileName, 'public');

    }

    public  function getPath()
    {
        return $this->path;
    }

    public function delete()
    {


        $image = $request->file('image');
        $imagePath = $image->store('images/products', 'public');
        $data['image'] = $imagePath;
    }


}
