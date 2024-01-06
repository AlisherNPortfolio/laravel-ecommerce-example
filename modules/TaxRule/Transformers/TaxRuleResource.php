<?php

namespace Modules\TaxRule\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TaxRuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
