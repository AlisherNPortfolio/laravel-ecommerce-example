<?php

namespace Modules\Banners\Observers;

use Modules\Banners\Models\BannerItem;

class BannerItemObserver
{
    /**
     * Handle the BannerItem "created" event.
     */
    public function created(BannerItem $bannerItem): void
    {
    }

    /**
     * Handle the BannerItem "updated" event.
     */
    public function updated(BannerItem $bannerItem): void
    {
    }

    /**
     * Handle the BannerItem "deleted" event.
     */
    public function deleted(BannerItem $bannerItem): void
    {
    }

    /**
     * Handle the BannerItem "restored" event.
     */
    public function restored(BannerItem $bannerItem): void
    {
    }

    /**
     * Handle the BannerItem "force deleted" event.
     */
    public function forceDeleted(BannerItem $bannerItem): void
    {
    }
}
