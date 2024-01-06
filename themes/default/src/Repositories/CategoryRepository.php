<?php

namespace Theme\Default\Repositories;
use Modules\Common\Repositories\ReadableRepository;
use Theme\Default\Models\ThemeCategory;

class CategoryRepository extends ReadableRepository
{
    public function __construct(ThemeCategory $model)
    {
        parent::__construct($model);
    }

    public function getMainCategories()
    {
        return $this->getQuery()->where('position', 1)->get();
    }
}
