<?php

namespace Modules\Product\Repositories;

use Illuminate\Http\UploadedFile;
use Modules\Common\Repositories\CrudRepository;
use Modules\Common\Services\FileService;
use Modules\Product\Contracts\Repositories\IProductMediaRepository;
use Modules\Product\Models\ProductMedia;

class ProductMediaRepository extends CrudRepository implements IProductMediaRepository
{
    public function __construct(ProductMedia $model)
    {
        parent::__construct($model);
    }

    public function uploadMedia(array $media, int $product_id): array
    {
        if (count($media) == 0) return [];

        $order = 1;
        $uploadedImages = [];
        foreach ($media as $mediaItem) {
            $fileData = app(FileService::class)->saveFile($mediaItem, 'public/products/');
            $uploadedImages[] = $fileData['name'];
            $this->model::query()->create([
                'product_id' => $product_id,
                'url' => $fileData['name'],
                'order' => $order++,
                'file_type' => FileService::mediaType($mediaItem),
            ]);
        }

        return $uploadedImages;
    }

    public function updateMedia(array $media, int $product_id): array
    {
        // remove existing files from db and server
        $uploadedMedia = array_values(
            array_filter($media, fn ($m) => gettype($m)=='string')
        );

        if (count($uploadedMedia) > 0) {
            $mediaInDb = $this->getQuery()->where('product_id', $product_id)->get();
            $mediaInDb->each(function ($dbMedia) use ($uploadedMedia) {
                if (!in_array($dbMedia->url, $uploadedMedia)) {
                    // app(FileService::class)->delete('public/' . $dbMedia->url);
                    $dbMedia->delete();
                }
            });
        }

        // add and upload new media
        $uploadingMedia = $this->uploadMedia(
            array_filter($media, fn ($m) => $m instanceof UploadedFile),
            $product_id);

        return $uploadingMedia;
    }

    public function deleteMedia(array $media, int $product_id, bool $onlyFromServer = false): void
    {
        foreach ($media as $mediaItem) {
            app(FileService::class)->delete($mediaItem['path']);
            // if ($) // TODO: product mediaItem remove from server
            if(! $onlyFromServer) {
                $this->model::query()->where('prdocut_id', '=', $product_id)
                                    ->where('url', '=', $mediaItem['path'])
                                    ->delete();
            }
        }
    }
}
