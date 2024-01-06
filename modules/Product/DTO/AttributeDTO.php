<?php

namespace Modules\Product\DTO;

use Modules\Common\DTO\BaseDTO;

class AttributeDTO extends BaseDTO
{
    public ?int $id;
    public string $name;
    public array $values;
}
