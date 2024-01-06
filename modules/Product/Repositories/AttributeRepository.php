<?php

namespace Modules\Product\Repositories;

use Modules\Common\Repositories\CrudRepository;
use Modules\Product\Contracts\Repositories\IAttributeRepository;
use Modules\Product\Models\Attribute;

class AttributeRepository extends CrudRepository implements IAttributeRepository
{
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
    }
}
