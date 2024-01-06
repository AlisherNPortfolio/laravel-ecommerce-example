<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Category\Services\CategoryService;
use Modules\Common\Http\Requests\PaginationRequest;
use Modules\Product\Http\Requests\ProductVariantRequest;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService, private CategoryService $categoryService)
    {
        $this->middleware('auth:admins');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        can_user('View Product');

        $data = $request->validated();
        $id = $data["id"] ?? 0;
        return $this->productService->getPaginate($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return int
     */
    public function create()
    {
        return 1;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        return $this->productService
                    ->insertIntoDTO($data)
                    ->add();
    }

    /**
     * Show the specified resource.
     *
     * @param int $product
     *
     * @return JsonResponse
     */
    public function show($product)
    {
        can_user('View Product');
        return $this->productService->getById((int)$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return int
     */
    public function edit($id)
    {
        return 1;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(StoreProductRequest $request, int $product)
    {
        $data = $request->validated();
        return $this->productService
                    ->insertIntoDTO($data, $product)
                    ->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $product)
    {
        return $this->productService->removeProduct($product);
    }

    public function storeVariants(ProductVariantRequest $request)
    {
        $data = $request->validated();
        return $this->productService->storeVariants($data);
    }
}
