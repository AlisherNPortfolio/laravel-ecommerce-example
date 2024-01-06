<?php

namespace Theme\Default\Repositories;
use Modules\Common\Repositories\CrudRepository;
use Theme\Default\Models\ThemeCartItem;

class CartItemRepository extends CrudRepository
{
    public function __construct(ThemeCartItem $model)
    {
        parent::__construct($model);
    }

    public function createOrUpdate(array $attributes)
    {
        $cartItem = $this->getQuery()
                        ->where('cart_id', $attributes['cart_id'])
                        ->where('product_id', $attributes['product_id'])
                        ->first();
        if ($cartItem) {
            $cartItem->qty += 1;
            $cartItem->save();
            return $cartItem->refresh();
        }

        return $this->model::query()->create($attributes);
    }
}
