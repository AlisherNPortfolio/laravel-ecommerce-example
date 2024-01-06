<?php

namespace Modules\Category\Contracts\Repositories;

use Modules\Common\Contracts\Repositories\ICrudRepository;

interface ICategoryRepository extends ICrudRepository
{
    public function getAsTree();
}
