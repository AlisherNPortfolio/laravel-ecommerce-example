<?php

namespace Modules\Brand\Services;

use Exception;
use Modules\Brand\Contracts\Repositories\IBrandRepository;
use Modules\Brand\Models\Brand;
use Modules\Brand\Transformers\BrandResource;
use Modules\Common\Services\BaseService;
use PDOException;

class BrandService extends BaseService
{

    public function __construct(protected IBrandRepository $repository)
    {
    }

    public function pagination($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);
        return $this->jsonSuccess(['data' => BrandResource::collection($data), 'count' => $count]);
    }

    public function create(array $data)
    {
        try {
            $this->repository->create($data);

            return $this->jsonSuccess(null, 'Brand created');
        } catch (Exception $e) {

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function getOne(int $id)
    {
        $brand = $this->repository->find($id);

        abort_if(!$brand, 404, 'Record not found!');

        return $this->jsonSuccess(new BrandResource($brand));
    }

    public function update(array $data, int $id)
    {
        abort_if(!$id, 400, 'ID must be an integer');

        try {
            $brand = $this->repository->find($id);
            abort_if(!$brand, 404, 'Resource not found!');

            $brand->update($data);

            return $this->jsonSuccess(null, 'Brand updated!');
        } catch (Exception $e) {

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function delete(Brand $brand)
    {
        try {
            abort_if($brand->products()->count() > 0, 400, 'Brand has products!');

            $brand->delete();

            return $this->jsonSuccess(null, 'Brand removed');
        } catch (PDOException $e) {

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function getAll()
    {
        try {
            $brands = $this->repository->all();

            return $this->jsonSuccess($brands);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }
}
