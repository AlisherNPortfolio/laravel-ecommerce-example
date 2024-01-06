<?php

namespace Theme\Default\Http\Controllers;

use App\Http\Controllers\Controller;
use Theme\Default\Services\ThemeCommonService;

class CommonController extends Controller
{
    public function __construct(protected ThemeCommonService $service)
    {

    }
}
