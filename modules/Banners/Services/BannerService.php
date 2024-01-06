<?php

namespace Modules\Banners\Services;

use Modules\Banners\DTO\BannerDTO;
use Modules\Banners\DTO\BannerItemDTO;
use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Banners\Contracts\Repositories\IBannerItemRepository;
use Modules\Banners\Contracts\Repositories\IBannerRepository;
use Modules\Banners\Models\Banner;
use Modules\Banners\Transformers\BannerResource;
use Modules\Common\Services\BaseService;
use PDOException;

class BannerService extends BaseService
{
    private BannerDTO $data;

    public function __construct(
        protected IBannerRepository $repository,
        protected IBannerItemRepository $bannerItemRepository
    )
    {
    }

    public function pagination($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage, ['banners']);
        return $this->jsonSuccess(['data' => BannerResource::collection($data), 'count' => $count]);
    }

    public function create()
    {
        DB::beginTransaction();
        try {
            $bannerData = [
                'name' => $this->data->name,
                'slug' => $this->data->slug,
                'is_active' => $this->data->is_active,
            ];

            $createdBanner = $this->repository->create($bannerData);

            if (isset($this->data->banners)) {
                foreach ($this->data->banners as $item) {
                    $this->bannerItemRepository->createWithImage([...$item->toArray(), 'banner_id' => $createdBanner->id]);
                }
            }

            DB::commit();

            return $this->jsonSuccess([], 'Баннер создан');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function getOne(int $id, array $relations)
    {
        $banner = $this->repository->find($id, $relations);
        $banner = new BannerResource($banner);

        abort_if(!$banner, 404, 'Record not found!');

        return $this->jsonSuccess(['data' => $banner]);
    }

    public function update(int $id)
    {
        abort_if(!$id, 400, 'ID must be an integer');

        DB::beginTransaction();
        try {
            $banner = $this->repository->find($id);
            abort_if(!$banner, 404, 'Resource not found!');

            $banner->update([
                'name' => $this->data->name,
                'slug' => $this->data->slug,
                'is_active' => $this->data->is_active
            ]);

            if (isset($this->data->banners)) {
                foreach ($this->data->banners as $item) {
                    $this->bannerItemRepository->updateWithImage($item->toArray(), $item->id);
                }
            }

            DB::commit();

            return $this->jsonSuccess([], 'Баннер обновлен');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function removeItem(int $id)
    {
        try {
            return $this->jsonSuccess([
                'removed' => $this->bannerItemRepository->remove($id)
            ]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function delete(Banner $banner)
    {
        DB::beginTransaction();
        try {
            $banner->delete();

            DB::commit();
            return $this->jsonSuccess([],'Banner removed');
        } catch (PDOException $e) {
            DB::rollBack();

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function insertIntoDTO(array $data, int $id = null)
    {
        if (isset($data['banners'])) {
            $items = [];

            foreach ($data['banners'] as $item) {
                if ($id) $item['banner_id'] = $id;
                $bannerItemDTO = new BannerItemDTO($item);
                $items[] = $bannerItemDTO;
            }

            $data['banners'] = $items;
        }

        if ($id) {
            $data['id'] = $id;
        }

        $this->data = new BannerDTO($data);

        return $this;
    }
}
