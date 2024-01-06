<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait LockDB
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function (Model $model) {
            return false;
        });

        static::creating(function (Model $model) {
            return false;
        });

        static::deleting(function (Model $model) {
            return false;
        });
    }
}
