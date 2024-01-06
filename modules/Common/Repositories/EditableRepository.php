<?php

namespace Modules\Common\Repositories;

use Modules\Common\Contracts\Repositories\IEditableRepository;
use Modules\Common\Traits\Repositories\TEditable;

class EditableRepository extends BaseRepository implements IEditableRepository
{
    use TEditable;
}
