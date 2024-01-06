<?php

namespace Modules\Brand\Repositories;

use Modules\Brand\Contracts\Repositories\IBrandRepository;
use Modules\Brand\Models\Brand;
use Modules\Common\Repositories\CrudRepository;

class BrandRepository extends CrudRepository implements IBrandRepository
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }
}
