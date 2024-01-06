<?php

namespace Modules\Category\Repositories;

use Modules\Category\Contracts\Repositories\ICategoryRepository;
use Modules\Category\Models\Category;
use Modules\Common\Repositories\CrudRepository;

class CategoryRepository extends CrudRepository implements ICategoryRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getAsTree()
    {
        return $this->model::query()->get()->buildTree();
    }
}
