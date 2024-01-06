<?php

namespace Modules\TaxRule\Repositories;

use Modules\Common\Repositories\CrudRepository;
use Modules\TaxRule\Contracts\Repositories\ITaxRuleRepository;
use Modules\TaxRule\Models\TaxRule;

class TaxRuleRepository extends CrudRepository implements ITaxRuleRepository
{
    public function __construct(TaxRule $model)
    {
        parent::__construct($model);
    }
}
