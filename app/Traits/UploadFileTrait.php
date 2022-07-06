<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Trait UploadFile
 * @package App\Traits
 */
trait UploadFileTrait
{
    /**
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadFile(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : $file->getClientOriginalName();
        $file->storeAs(
            $folder,
            $name,
            $disk
        );

        return $name;
    }

    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteFile($path, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}
