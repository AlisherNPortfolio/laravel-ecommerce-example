<?php

namespace Modules\User\Repositories;

use Modules\User\Models\User;
use Modules\Common\Repositories\CrudRepository;
use Modules\User\Contracts\Repositories\IUserRepository;

class UserRepository extends CrudRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
