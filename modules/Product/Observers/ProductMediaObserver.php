<?php

namespace Modules\Product\Observers;

use Modules\Common\Services\FileService;
use Modules\Product\Models\ProductMedia;

class ProductMediaObserver
{
    /**
     * Handle the ProductMedia "created" event.
     */
    public function created(ProductMedia $productMedia): void
    {
        //
    }

    /**
     * Handle the ProductMedia "updated" event.
     */
    public function updated(ProductMedia $productMedia): void
    {
        //
    }

    /**
     * Handle the ProductMedia "deleted" event.
     */
    public function deleted(ProductMedia $productMedia): void
    {
        app(FileService::class)->delete('public/' . $productMedia->url);
    }

    /**
     * Handle the ProductMedia "restored" event.
     */
    public function restored(ProductMedia $productMedia): void
    {
        //
    }

    /**
     * Handle the ProductMedia "force deleted" event.
     */
    public function forceDeleted(ProductMedia $productMedia): void
    {
        //
    }
}
