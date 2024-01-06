<?php

namespace Modules\Payment\Repositories;
use Modules\Common\Repositories\CrudRepository;
use Modules\Payment\Contracts\Repositories\IPaymentTypeSettingRepository;
use Modules\Payment\Models\PaymentTypeSetting;

class PaymentTypeSettingRepository extends CrudRepository implements IPaymentTypeSettingRepository
{
    public function __construct(PaymentTypeSetting $model)
    {
        parent::__construct($model);
    }

    public function bulkyRemove(int $paymentId): void
    {
        $this->model::query()->where('payment_type_id', '=', $paymentId)->delete();
    }
}
