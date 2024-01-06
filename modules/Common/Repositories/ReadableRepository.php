<?php

namespace Modules\Common\Repositories;

use Modules\Common\Contracts\Repositories\IReadableRepository;
use Modules\Common\Traits\Repositories\TReadable;

class ReadableRepository extends BaseRepository implements IReadableRepository
{
    use TReadable;
}
