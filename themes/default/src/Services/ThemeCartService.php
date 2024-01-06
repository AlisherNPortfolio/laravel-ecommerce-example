<?php

namespace Theme\Default\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Transformers\CartItemResource;
use Modules\Cart\Transformers\CartResource;
use Modules\Common\Services\BaseService;
use Theme\Default\Repositories\CartItemRepository;
use Theme\Default\Repositories\CartRepository;

class ThemeCartService extends BaseService
{
    public function __construct(
            protected CartRepository $repository,
            protected CartItemRepository $itemRepository
        )
    {

    }

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);

        return $this->jsonSuccess([
            'data' => CartResource::collection($data),
            'count' => $count ]
        );
    }

    public function add(array $cartItem)
    {
        DB::beginTransaction();
        try {
            $cart = $this->repository->createOrUpdate();
            $cartItemDb = $this->itemRepository->createOrUpdate([
                'cart_id' => $cart->id,
                'product_id' => $cartItem['product_id'],
                'qty' => $cartItem['qty']
            ]);

            DB::commit();

            $cart->refresh();

            return $this->jsonSuccess(new CartResource($cart));
        } catch (Exception $e) {

            DB::rollBack();
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }
}
