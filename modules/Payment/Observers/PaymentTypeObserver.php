<?php

namespace Modules\Payment\Observers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Modules\Common\Services\FileService;
use Modules\Payment\Models\PaymentType;

class PaymentTypeObserver
{
    public function creating(PaymentType $paymentType): void
    {
        $image = request()->file('image');
        $imagePath = app(FileService::class)->saveFile($image, 'public/payments/');
        $paymentType->image = $imagePath['name'];
    }
    /**
     * Handle the PaymentType "created" event.
     */
    public function created(PaymentType $paymentType): void
    {
        //
    }

    public function updating(PaymentType $paymentType): void
    {
        $image = request()->file('image');

        if ($image instanceof UploadedFile) {
            $fileService = app(FileService::class);

            $imagePath = $fileService->saveFile($image, 'public/payments/');
            $fileService->delete("public/{$paymentType->image}");

            $paymentType->image = $imagePath['name'];
        }
    }

    /**
     * Handle the PaymentType "updated" event.
     */
    public function updated(PaymentType $paymentType): void
    {
        //
    }

    /**
     * Handle the PaymentType "deleted" event.
     */
    public function deleted(PaymentType $paymentType): void
    {
        app(FileService::class)->delete("public/{$paymentType->image}");
    }

    /**
     * Handle the PaymentType "restored" event.
     */
    public function restored(PaymentType $paymentType): void
    {
        //
    }

    /**
     * Handle the PaymentType "force deleted" event.
     */
    public function forceDeleted(PaymentType $paymentType): void
    {
        //
    }
}
