<?php

namespace Modules\Banners\DTO;

use Modules\Common\DTO\BaseDTO;

class BannerDTO extends BaseDTO
{
    public string $name;
    public string $slug;
    public bool $is_active;
    public array $banners;
    public ?int $id = null;
}
