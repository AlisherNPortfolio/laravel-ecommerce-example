<?php

namespace Theme\Default\Http\Controllers;
use App\Http\Controllers\Controller;
use Theme\Default\Services\ThemeProductService;

class ProductController extends Controller
{
    public function __construct(protected ThemeProductService $service)
    {

    }

    public function getProducts()
    {
        return $this->service->products();
    }
}
