<?php
namespace Modules\Cart\Repositories;

use Modules\Cart\Contracts\Repositories\ICartRepository;
use Modules\Cart\Models\Cart;
use Modules\Common\Repositories\CrudRepository;

class CartRepository extends CrudRepository implements ICartRepository
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }
}
