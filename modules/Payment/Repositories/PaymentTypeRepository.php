<?php

namespace Modules\Payment\Repositories;
use Modules\Common\Repositories\CrudRepository;
use Modules\Payment\Contracts\Repositories\IPaymentTypeRepository;
use Modules\Payment\Models\PaymentType;

class PaymentTypeRepository extends CrudRepository implements IPaymentTypeRepository
{
    public function __construct(PaymentType $model)
    {
        parent::__construct($model);
    }
}