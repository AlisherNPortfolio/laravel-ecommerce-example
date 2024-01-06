<?php

namespace Modules\Common\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IEditableRepository
{
    public function create(array $attributes): Model;

    public function update(array $attributes): bool;

    public function delete(int $id): ?bool;
}
