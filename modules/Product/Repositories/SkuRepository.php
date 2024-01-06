<?php

namespace Modules\Product\Repositories;

use Modules\Common\Repositories\CrudRepository;
use Modules\Product\Contracts\Repositories\ISkuRepository;
use Modules\Product\Models\Sku;

class SkuRepository extends CrudRepository implements ISkuRepository
{
    public function __construct(Sku $model)
    {
        parent::__construct($model);
    }
}
