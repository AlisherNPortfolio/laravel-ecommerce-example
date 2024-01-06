<?php

namespace Modules\Banners\Repositories;

use Modules\Banners\Models\BannerItem;
use Modules\Common\Services\FileService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Modules\Banners\Contracts\Repositories\IBannerItemRepository;
use Modules\Common\Repositories\CrudRepository;

class BannerItemRepository extends CrudRepository implements IBannerItemRepository
{
    public function __construct(BannerItem $model)
    {
        parent::__construct($model);
    }

    public function createWithImage(array $attributes)
    {
        $image = $attributes['image'];
        $path = app(FileService::class)->saveFile($image, 'public/banners/', [], true);

        if ($path && is_array($path)) {
            $attributes['image'] = $path['name'];
        } else {
            abort(422, 'File could not be uploaded!');
        }

        return $this->create($attributes);
    }

    public function updateWithImage(array $attributes, ?int $id): bool|Model|null
    {
        try {
            if (!$id) {
                return $this->createWithImage($attributes);
            }

            $bannerItem = $this->find($id);

            $imageAttr = $attributes['image'];

            if (isset($imageAttr) && $imageAttr && !is_string($imageAttr)) {
                $fileService = app(FileService::class);
                $fileService->delete('public/' . $bannerItem->image);

                $path = $fileService->saveFile($imageAttr, 'public/banners/', [], true);

                if ($path && is_array($path)) {
                    $imageAttr = $path['name'];
                } else {
                    abort(422, 'File could not be uploaded!');
                }
            }
            // $attributes['is_active'] = $attributes['is_active'] === 'true';

            return $bannerItem->update($attributes);
        } catch (Exception $e) {
            abort(422, env_dependend_error($e->getMessage()));
        }
    }

    public function remove(int $id): ?bool
    {
        $item = $this->find($id);
        abort_if(!$item, 404, 'Record not found');

        try {
            app(FileService::class)->delete("public/{$item->image}");
            return $item->delete();
        } catch (Exception $e) {
            abort($e->getCode(), env_dependend_error($e->getMessage()));
        }
    }
}
