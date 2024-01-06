<?php

namespace Modules\Product\Repositories;

use Modules\Common\Repositories\CrudRepository;
use Modules\Product\Contracts\Repositories\IAttributeValueRepository;
use Modules\Product\Models\AttributeValue;

class AttributeValueRepository extends CrudRepository implements IAttributeValueRepository
{
    public function __construct(AttributeValue $model)
    {
        parent::__construct($model);
    }

    public function updateMultiple(array $attributes, int $attribute_id): void
    {
        $attributeValues = $this->model::query()->where("attribute_id", $attribute_id)->get();
        $formValues = collect($attributes);
        
        // remove if db data doesn't exist in form data
        $attributeValues->each(function ($item) use ($formValues) {
            if ($formValues->where('value', '=', $item->value)->count() == 0) {
                $item->delete();
            }
        });

        // add if form data doesn't exist in db, otherwise update it
        $formValues->each(function ($item) use ($attributeValues, $attribute_id) {
            if ($attributeValues->where('value', '=', $item['value'])->count() == 0) {
                $this->create([
                    ...$item,
                    'attribute_id' => $attribute_id,
                ]);
            } else {
                $attributeValues->where('value', '=', $item['value'])->first()->update($item);
            }
        });
    }
}
