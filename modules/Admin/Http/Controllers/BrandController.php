<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Brand\Http\Requests\StoreBrandRequest;
use Modules\Brand\Models\Brand;
use Modules\Brand\Services\BrandService;
use Modules\Common\Http\Requests\PaginationRequest;

class BrandController extends Controller
{
    public function __construct(protected BrandService $brandService)
    {
        $this->middleware("auth:admins");
    }
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        can_user('View Category'); // TODO: Brand uchun permission qo'shish

        $data = $request->validated();
        $id = $data["id"] ?? 0;

        return $this->brandService->pagination($id);
    }

    public function all()
    {
        return $this->brandService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(StoreBrandRequest $request)
    {
        $data = $request->validated();

        return $this->brandService->create($data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($brand)
    {
        can_user('View Category');
        return $this->brandService->getOne((int)$brand);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $brand
     * @return JsonResponse
     */
    public function update(Request $request, $brand)
    {
        can_user('Update Category');

        $data = $request->validated();
        $brand = (int)$brand;

        return $this->brandService->update($data, $brand);
    }

    /**
     * Remove the specified resource from storage.
     * @param Brand $brand
     * @return JsonResponse
     */
    public function destroy($brand)
    {
        can_user('Delete Category');
        return $this->brandService->delete($brand);
    }
}
