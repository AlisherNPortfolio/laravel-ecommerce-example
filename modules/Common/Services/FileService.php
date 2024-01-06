<?php

namespace Modules\Common\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public const MEDIA_TYPE_UNKNOWN = 0;
    public const MEDIA_TYPE_IMAGE = 1;
    public const MEDIA_TYPE_VIDEO = 2;

    public function delete(string $path)
    {
        $storage = Storage::disk(config('multishop.storage.disc'));

        return $storage->exists($path) ? $storage->delete($path) : false;
    }

    public function saveFile(string|object $fileName, string $directory = '', $fileTypes = [], $isImage = false)
    {
        $originalName = false;
        if (is_object($fileName)) {
            $file = $fileName;
            $originalName = $file->getClientOriginalName();
        } else {
            $file = request()->file($fileName);
        }

        if (is_null($file)) {
            return false;
        }

        if (File::size($file) > config('multishop.file.max_size', 'local')) {
            throw new \Exception('File size is large');
        }

        $extension = $file->getClientOriginalExtension();
        $newFileName = md5(rand(1111, 9999).time());

        if (!empty($fileTypes)) {
            if (!in_array($extension, $fileTypes)) {
                throw new \Exception('Invalid file type', 1);
            }
        }

        Storage::disk(config('multishop.storage.disc', 'local'))->put($directory .$newFileName.'.'.$extension, File::get($file));

        if ($isImage) {
            $storage = Storage::disk(config('multishop.storage.disc', 'local'));
            $image = $storage->get($directory.$newFileName.'.'.$extension);

            $image = InterventionImage::make($image)->resize(config('multishop.file.max_resize', 800), null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $imageResized = $image->stream();

            $storage->delete($directory.$newFileName.'.'.$extension);
            $storage->put($directory.$newFileName.'.'.$extension, $imageResized->__toString());
        }

        if (config('multishop.storage.disc', 'local') == 'local' && strpos($directory, 'public') === 0) {
            $directory = str_replace('public/', '', $directory);
        }

        return [
            'original' => $originalName ?: $file->getFilename().'.'.$extension,
            'name' => $directory.$newFileName.'.'.$extension
        ];
    }

    public function saveFiles(array $fileNames, string $directory = '', $fileTypes = [], $isImage = false)
    {
        $uploadedFiles = [];
        foreach ($fileNames as $fileName) {
            $uploadedFiles[] = $this->saveFile($fileName, $directory, $fileTypes, $isImage);
        }

        return $uploadedFiles;
    }

    public static function mediaType(UploadedFile|string $media): int
    {
        if ($media instanceof UploadedFile) {
            $media = $media->clientExtension();
        }

        return match($media) {
            'png', 'jpg', 'jpeg', 'webp',
            'svg'=> self::MEDIA_TYPE_IMAGE,
            'mp4' => self::MEDIA_TYPE_VIDEO,
            default => self::MEDIA_TYPE_UNKNOWN
        };
    }
}
