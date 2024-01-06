<?php

namespace App\Utils\NestedSet;

trait NestedSet
{
    public function newCollection(array $models = [])
    {
        $collection = new Collection($models);
        $config = [
            'left_key' => $this->left_key ?? 'lft',
            'right_key' => $this->right_key ?? 'rgt',
            'displayName' => $this->displayName ?? 'name',
            'displayOtherFields' => $this->displayOtherFields ?? [],
        ];
        $collection->setConfig($config);

        return $collection;
    }
}
