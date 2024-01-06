<?php

namespace Modules\Product\DTO;

use Modules\Common\DTO\BaseDTO;

class MediaDTO extends BaseDTO
{
    public int $product_id;
    public string $url;
    public ?int $order;
    public int $file_type;
}
