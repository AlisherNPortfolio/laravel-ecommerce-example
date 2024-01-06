<?php

namespace Modules\Product\Repositories;

use Modules\Common\Repositories\CrudRepository;
use Modules\Product\Contracts\Repositories\IProductRepository;
use Modules\Product\Models\Product;

class ProductRepository extends CrudRepository implements IProductRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
