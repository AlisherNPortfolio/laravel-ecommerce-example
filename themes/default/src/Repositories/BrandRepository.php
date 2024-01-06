<?php

namespace Theme\Default\Repositories;
use Modules\Common\Repositories\ReadableRepository;
use Theme\Default\Models\ThemeBrand;

class BrandRepository extends ReadableRepository
{
    public function __construct(ThemeBrand $model)
    {
        parent::__construct($model);
    }
}
