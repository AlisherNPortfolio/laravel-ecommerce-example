<?php

namespace Modules\Common\Repositories;

use Modules\Common\Contracts\Repositories\ICrudRepository;
use Modules\Common\Traits\Repositories\TEditable;
use Modules\Common\Traits\Repositories\TReadable;

class CrudRepository extends BaseRepository implements ICrudRepository
{
    use TEditable;
    use TReadable;
}
