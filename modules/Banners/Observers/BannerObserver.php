<?php

namespace Modules\Banners\Observers;

use Modules\Banners\Models\Banner;

class BannerObserver
{
    /**
     * Handle the BannerItem "created" event.
     */
    public function created(Banner $banner): void
    {
    }

    /**
     * Handle the BannerItem "updated" event.
     */
    public function updated(Banner $banner): void
    {
    }

    public function deleting(Banner $banner): void
    {
        $banner->banners()->delete();
    }

    /**
     * Handle the BannerItem "deleted" event.
     */
    public function deleted(Banner $banner): void
    {
    }

    /**
     * Handle the BannerItem "restored" event.
     */
    public function restored(Banner $banner): void
    {
    }

    /**
     * Handle the BannerItem "force deleted" event.
     */
    public function forceDeleted(Banner $banner): void
    {
    }
}
