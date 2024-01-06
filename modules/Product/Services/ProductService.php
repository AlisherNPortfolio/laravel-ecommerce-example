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
    public function add()
    {
        DB::beginTransaction();
        try {
            $product = $this->repository->create(
                $this->dtoData->toArray(['images', 'videos'], true)
            ); // ProductDTO

            $this->mediaRepository->uploadMedia([
                ...$this->dtoData->images,
                ...(isset($this->dtoData->videos) ? $this->dtoData->videos : []),
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

    public function update()
    {
        DB::beginTransaction();
        try {
            $productDTO = $this->dtoData;
            $product = $this->repository->find($productDTO->id);
            abort_if(!$product, 404, 'Product not found');

            $product->update(
                $productDTO->toArray(['videos', 'images'], true)
            );

            $media = [];

            if(isset($this->dtoData->images)) {
                $media = $this->dtoData->images;
            }

            if(isset($this->dtoData->videos)) {
                $media = array_merge($media, $this->dtoData->videos);
            }

            $this->mediaRepository->updateMedia($media, $productDTO->id);

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

    /**
     * Insert data from request into DTO objects
     *
     * @param array $data
     * @param integer|null $id
     * @return static
     */
    public function insertIntoDTO(array $data, int $id = null)
    {
        // if (isset($data['media']) && count($data['media'])) {
        //     $media = [];
        //     foreach ($data['media'] as $image) {
        //         $media[] = new UploadableImageDTO(['image' => $image]);
        //     }

        //     $data['media'] = $media;
        // }

        // if ($data['values']) {}

        if ($id) {
            $data['id'] = $id;
        }

        $this->dtoData = new ProductDTO($data);

        return $this;
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
