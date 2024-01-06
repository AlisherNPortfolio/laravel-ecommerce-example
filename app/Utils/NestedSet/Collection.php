<?php

namespace App\Utils\NestedSet;

use Illuminate\Database\Eloquent\Collection as LaravelCollection;

class Collection extends LaravelCollection
{
    protected $left_key = 'lft';

    protected $right_key = 'rgt';

    protected $displayName = 'name';

    protected $displayOtherFields = [];

    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }

    /**
     * Builds Nested Set Tree.
     *
     * @return self
     */
    public function buildTree()
    {
        return new static($this->formTree($this->items));
    }

    public function formTree(array $model, $lft = 0, $rgt = null)
    {
        $tree = [];
        foreach ($model as $key => $val) {
            if ($val[$this->left_key] == $lft + 1 && (is_null($rgt) || $val[$this->right_key] < $rgt)) {
                $tree[$key] = [];
                $tree[$key] = $this->fillDisplayingFields($val);
                if ($val[$this->right_key] - $val[$this->left_key] > 1) {
                    $tree[$key]['children'] = $this->formTree($model, $val[$this->left_key], $val[$this->right_key]);
                }
                $lft = $val[$this->right_key];
            }
        }

        return $tree;
    }

    protected function fillDisplayingFields($data)
    {
        $result = [$this->displayName => $data[$this->displayName]];

        if (isset($this->displayOtherFields) && is_array($this->displayOtherFields) && count($this->displayOtherFields)) {
            foreach ($this->displayOtherFields as $field) {
                $result[$field] = $data[$field];
            }
        }

        return $result;
    }

    public function setConfig($config = [])
    {
        if (count($config) > 0) {
            foreach ($config as $key => $item) {
                if (isset($this->{$key})) {
                    $this->{$key} = $item;
                }
            }
        }
    }
}
