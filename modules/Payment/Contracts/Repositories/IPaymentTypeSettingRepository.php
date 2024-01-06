<?php

namespace Modules\Payment\Contracts\Repositories;

use Modules\Common\Contracts\Repositories\ICrudRepository;

interface IPaymentTypeSettingRepository extends ICrudRepository
{
    public function bulkyRemove(int $paymentId): void;
}
