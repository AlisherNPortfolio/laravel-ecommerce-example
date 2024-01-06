<?php

namespace Theme\Default\Services;

use Modules\Brand\Transformers\BrandResource;
use Modules\Category\Transformers\CategoryResource;
use Modules\Common\Services\BaseService;
use Theme\Default\Repositories\BrandRepository;
use Theme\Default\Repositories\CategoryRepository;

class ThemeCommonService extends BaseService
{
    public function __construct(
        protected BrandRepository $brandRepository,
        protected CategoryRepository $categoryRepository
        )
    {

    }

    public function categories()
    {
        return CategoryResource::collection($this->categoryRepository->getMainCategories());
    }

    public function brands()
    {
        return BrandResource::collection($this->brandRepository->all());
    }
}
