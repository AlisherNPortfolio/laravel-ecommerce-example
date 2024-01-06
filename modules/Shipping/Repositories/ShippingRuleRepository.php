<?php

namespace Modules\Shipping\Repositories;

use Modules\Common\Repositories\CrudRepository;
use Modules\Shipping\Contracts\Repositories\IShippingRuleRepository;
use Modules\Shipping\Models\ShippingRule;

class ShippingRuleRepository extends CrudRepository implements IShippingRuleRepository
{
    public function __construct(ShippingRule $model)
    {
        parent::__construct($model);
    }
}
