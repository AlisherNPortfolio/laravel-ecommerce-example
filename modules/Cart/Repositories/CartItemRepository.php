<?php
namespace Modules\Cart\Repositories;

use Modules\Cart\Contracts\Repositories\ICartItemRepository;
use Modules\Cart\Models\CartItem;
use Modules\Common\Repositories\CrudRepository;

class CartItemRepository extends CrudRepository implements ICartItemRepository
{
    public function __construct(CartItem $model)
    {
        parent::__construct($model);
    }
}
