<?php

namespace Modules\Shipping\Services;

use Exception;
use Modules\Common\Services\BaseService;
use Modules\Shipping\Contracts\Repositories\IShippingRepository;
use Modules\Shipping\Transformers\ShippingResource;

class ShippingService extends BaseService
{
    public function __construct(private IShippingRepository $repository)
    {
    }

    public function getAll()
    {
        try {
            $shippings = $this->repository->all(['rules']);

            return $this->jsonSuccess(ShippingResource::collection($shippings));
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);
        return $this->jsonSuccess([
            'data' => ShippingResource::collection($data),
            'count' => $count]
        );
    }

    public function getById($id)
    {
        $shipping = $this->repository->find($id);
        abort_if(!$shipping, 404, "Shipping method not found!");

        return $this->jsonSuccess($shipping);
    }

    public function add(array $data)
    {
        try {
            $this->repository->create($data);

            return $this->jsonSuccess(['message' => "Created!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function update(array $data, int|string $id)
    {
        try {
            $category = $this->repository->find($id);
            abort_if(!$category, 404, "Category not found");

            $category->update($data);

            return $this->jsonSuccess(['message' => "Updated!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function delete(int $id)
    {
        try {
            $this->repository->delete($id);
            return $this->jsonSuccess(["message"=> "Deleted!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }
}
