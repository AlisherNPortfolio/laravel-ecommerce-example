<?php

namespace Modules\Product\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Common\Services\BaseService;
use Modules\Product\Contracts\Repositories\IAttributeRepository;
use Modules\Product\Contracts\Repositories\IAttributeValueRepository;
use Modules\Product\DTO\AttributeDTO;
use Modules\Product\DTO\AttributeValueDTO;
use Modules\Product\Transformers\AttributeResource;
use Modules\Product\Transformers\ProductResource;

class AttributeService extends BaseService
{

    public function __construct(protected IAttributeRepository $repository, protected IAttributeValueRepository $valueRepository)
    {
    }

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);

        return $this->jsonSuccess([
            'data' => AttributeResource::collection($data),
            'count' => $count, ]
        );
    }

    /**
     *
     *
     * @return JsonResponse
     */
    public function add(array $data)
    {
        DB::beginTransaction();
        try {
            $attribute = $this->repository->create(['name' => $data['name']]); // ProductDTO


            $attribute->values()->createMany($data['values']);

            DB::commit();
            return $this->jsonSuccess('Created!');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        try {
            $attribute = $this->repository->find($id);
            abort_if(!$attribute, 404, 'Attribute not found');

            $attribute->update(['name' => $data['name']]);

            $this->valueRepository->updateMultiple($data['values'], $id);

            // foreach ($this->dtoData->values as $value) {
            //     $this->valueRepository->updateMultiple($value, $attribute->id);
            // }

            DB::commit();

            return $this->jsonSuccess('Updated!');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->jsonError(
                env_dependend_error($e->getMessage() . ' Line:' . $e->getLine() . ' File:' . $e->getFile())
            );
        }
    }

    public function getById($id)
    {
        $attribute = $this->repository->find($id, ['values']);
        abort_if(!$attribute, 404, "Attribute not found!");

        return $this->jsonSuccess(
            new AttributeResource($attribute)
        );
    }

    public function getAll()
    {
        try {
            $shippings = $this->repository->all(['values']);

            return $this->jsonSuccess(AttributeResource::collection($shippings));
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }
}
