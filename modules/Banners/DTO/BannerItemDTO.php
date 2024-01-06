<?php

namespace Modules\Banners\DTO;

use Modules\Common\DTO\BaseDTO;

class BannerItemDTO extends BaseDTO
{
    public ?int $id = null;
    public ?int $banner_id;
    public string $title;
    public bool $is_active;
    public object|string|null $image;
    public ?string $short_description;
    public ?string $description;
    public ?string $button;
    public ?string $link;
    public ?string $meta_keywords;
    public ?string $meta_description;
}
