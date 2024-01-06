<?php

namespace Modules\Banners\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Banners\Contracts\Repositories\IBannerRepository;
use Modules\Banners\Models\Banner;
use Modules\Common\Repositories\CrudRepository;

class BannerRepository extends CrudRepository implements IBannerRepository
{
    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }

    public function getActive(int $id, array $relations = []): ?Model
    {
        $query = $this->getQuery($relations);

        return $query->active()->find($id);
    }
}
