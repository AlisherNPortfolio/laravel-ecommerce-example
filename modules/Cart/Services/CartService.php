<?php
namespace Modules\Cart\Services;

use Modules\Cart\Contracts\Repositories\ICartItemRepository;
use Modules\Cart\Contracts\Repositories\ICartRepository;
use Modules\Cart\Transformers\CartResource;
use Modules\Common\Services\BaseService;

class CartService extends BaseService
{
    public function __construct(
        protected ICartRepository $repository,
        protected ICartItemRepository $itemRepository
    )
    {}

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);
        return $this->jsonSuccess([
            'data' => CartResource::collection($data),
            'count' => $count
        ]);
    }
}
