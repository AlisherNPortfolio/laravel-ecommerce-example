<?php

namespace Modules\Banners\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Contracts\Repositories\ICrudRepository;

interface IBannerItemRepository extends ICrudRepository
{
    public function createWithImage(array $attributes);

    public function updateWithImage(array $attributes, int $id): bool|Model|null;

    public function remove(int $id): ?bool;
}
