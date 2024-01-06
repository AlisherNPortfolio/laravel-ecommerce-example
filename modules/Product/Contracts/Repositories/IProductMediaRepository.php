<?php

namespace Modules\Product\Contracts\Repositories;

use Modules\Common\Contracts\Repositories\ICrudRepository;

interface IProductMediaRepository extends ICrudRepository
{
    public function uploadMedia(array $media, int $product_id): array;

    public function deleteMedia(array $media, int $product_id, bool $onlyFromServer = false): void;

    public function updateMedia(array $media, int $product_id): array;
}
