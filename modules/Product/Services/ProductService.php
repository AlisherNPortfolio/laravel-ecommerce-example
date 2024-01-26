<?php

namespace Modules\Product\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Common\Services\BaseService;
use Modules\Product\Contracts\Repositories\IProductMediaRepository;
use Modules\Product\Contracts\Repositories\IProductRepository;
use Modules\Product\Contracts\Repositories\ISkuRepository;
use Modules\Product\DTO\ProductDTO;
use Modules\Product\Transformers\ProductResource;

class ProductService extends BaseService
{

    private $dtoData;

    public function __construct(
        protected IProductRepository $repository,
        protected IProductMediaRepository $mediaRepository,
        protected ISkuRepository $skuRepository)
    {
    }

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);

        return $this->jsonSuccess([
            'data' => ProductResource::collection($data),
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
            $images = $data['images'];
            $videos = isset($data['videos']) ? $data['videos'] : [];
            unset($data['images'], $data['videos']);
            $product = $this->repository->create($data); // ProductDTO

            $this->mediaRepository->uploadMedia([
                ...$images,
                ...$videos,
            ], $product->id);

            DB::commit();
            return $this->jsonSuccess('Created!');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function update(array $data, int $productId)
    {
        DB::beginTransaction();
        try {
            $product = $this->repository->find($productId);
            abort_if(!$product, 404, 'Product not found');

            $media = isset($data['images']) ? $data['images'] : [];
            $videos = isset($data['videos']) ? $data['videos'] : [];
            unset($data['images'], $data['videos']);

            $product->update($data);

            if(count($videos)) {
                $media = array_merge($media, $videos);
            }

            $this->mediaRepository->updateMedia($media, $productId);

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
        $product = $this->repository->find($id, ['media']);
        abort_if(!$product, 404, "Product not found!");

        return $this->jsonSuccess(
            new ProductResource($product)
        );
    }

    public function storeVariants(array $data)
    {
        DB::beginTransaction();
        try {

            $product_id = $data["product_id"];
            $skus = $data["variants"];
            foreach($skus as $sku) {
                $skuItem = $this->skuRepository->create([...$sku, 'product_id' => $product_id]);
                $this->saveSkuAttributeValues($sku['values'], $skuItem->id);
            }

            DB::commit();

            return $this->jsonSuccess('Saved');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function removeProduct(int $productId)
    {
        DB::beginTransaction();
        try {
            $product = $this->repository->find($productId);

            abort_if(!$product, 404, 'Product not found!');

            $product->delete();

            DB::commit();

            return $this->jsonSuccess(true);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->jsonSuccess(
                env_dependend_error($e->getMessage())
            );
        }
    }

    protected function saveSkuAttributeValues(array $attributeValues, int $skuId)
    {
        foreach ($attributeValues as $attrVal) {
            DB::table('sku_attribute_value')->insert([
                'sku_id' => $skuId,
                'attribute_value_id' => $attrVal
            ]);
        }
    }
}
