<?php

namespace Theme\Default\Repositories;
use Modules\Common\Repositories\ReadableRepository;
use Theme\Default\Models\ThemeProduct;

class ProductRepository extends ReadableRepository
{
    public function __construct(ThemeProduct $model)
    {
        parent::__construct($model);
    }

    public function getHomeData()
    {
        $query = $this->getQuery()->isActive(true);

        $featured = (clone $query)->isFeatured(true)->get();
        $latest = $query->isActive(true)->latest()->limit(9)->get();
        return [
            'featured' => $featured,
            'latest' => $latest
        ];
    }
}
