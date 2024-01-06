<?php

namespace Modules\Admin\Actions;

use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;
use Modules\Product\Models\Product;

class LinkOption
{
    use AsAction;

    public function handle(Product $product, Collection|array $data): Product
    {
        $product->options()->sync($data);
        return $product;
    }
}
