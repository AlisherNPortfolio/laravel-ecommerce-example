<?php

namespace Theme\Default\Http\Controllers;
use App\Http\Controllers\Controller;
use Theme\Default\Services\ThemeCommonService;
use Theme\Default\Services\ThemeProductService;

class HomeController extends Controller
{
    public function __construct(
        protected ThemeProductService $productService,
        protected ThemeCommonService $commonService
        )
    {

    }
    public function index()
    {
        $products = $this->productService->products();
        $categories = $this->commonService->categories();

        return success_response([
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
