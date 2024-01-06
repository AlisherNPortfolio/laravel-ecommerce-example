<?php

namespace Modules\Product\Contracts\Repositories;

use Modules\Common\Contracts\Repositories\ICrudRepository;

interface IAttributeValueRepository extends ICrudRepository
{
    public function updateMultiple(array $attributes, int $attribute_id): void;
}
