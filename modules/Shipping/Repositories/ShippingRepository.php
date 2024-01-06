<?php

namespace Modules\Shipping\Repositories;

use Modules\Common\Repositories\CrudRepository;
use Modules\Shipping\Contracts\Repositories\IShippingRepository;
use Modules\Shipping\Models\Shipping;

class ShippingRepository extends CrudRepository implements IShippingRepository
{
    public function __construct(Shipping $model)
    {
        parent::__construct($model);
    }
}
