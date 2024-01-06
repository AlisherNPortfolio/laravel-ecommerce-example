<?php

namespace Modules\Product\DTO;

use Modules\Common\DTO\BaseDTO;

class AttributeValueDTO extends BaseDTO
{
    public ?int $id;
    public int $attribute_id;
    public string|int $value;
}
