<?php

namespace Modules\Admin\Repositories;

use Modules\Admin\Contracts\Repositories\IAdminRepository;
use Modules\Admin\Models\Admin;
use Modules\Common\Repositories\CrudRepository;

class AdminRepository extends CrudRepository implements IAdminRepository
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}
