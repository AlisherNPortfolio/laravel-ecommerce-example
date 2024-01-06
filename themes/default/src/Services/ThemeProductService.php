<?php

namespace Theme\Default\Services;
use Modules\Common\Services\BaseService;
use Modules\Product\Transformers\ProductResource;
use Theme\Default\Repositories\ProductRepository;

class ThemeProductService extends BaseService
{
    public function __construct(protected ProductRepository $repository)
    {

    }

    public function products()
    {
        $products = $this->repository->getHomeData();
        return [
            'featured' => ProductResource::collection($products['featured']),
            'latest' => ProductResource::collection($products['latest'])
        ];
    }
}
