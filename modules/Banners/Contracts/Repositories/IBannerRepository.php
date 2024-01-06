<?php

namespace Modules\Banners\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Contracts\Repositories\ICrudRepository;

interface IBannerRepository extends ICrudRepository
{
    public function getActive(int $id, array $relations = []): ?Model;
}
