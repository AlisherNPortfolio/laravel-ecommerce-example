<?php

namespace Theme\Default\Repositories;
use Modules\Common\Repositories\CrudRepository;
use Theme\Default\Models\ThemeCart;

class CartRepository extends CrudRepository
{
    public function __construct(ThemeCart $model)
    {
        parent::__construct($model);
    }

    public function createOrUpdate()
    {
        $userId = 1; //Auth::guard('api')->user()->id;
        $cart = $this->getQuery()->where('user_id', $userId)->first();
        if (!$cart) {
            return $this->getQuery()->create(['user_id' => $userId]);
        }

        return $cart;
    }
}
