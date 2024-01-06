<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Http\Requests\StoreCategoryRequest;
use Modules\Category\Services\CategoryService;
use Modules\Common\Http\Requests\PaginationRequest;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
        $this->middleware('auth:admins');
    }
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        can_user('View Category');

        $data = $request->validated();
        $id = $data["id"] ?? 0;
        return $this->categoryService->getPaginate($id);
    }

    /**
     * Show the form for creating a new resource.
     * @return mixed
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        return $this->categoryService->add($data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return mixed
     */
    public function show($category)
    {
        can_user('View Category');
        return $this->categoryService->getById((int)$category);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        //
    }

    public function getTree()
    {
        return $this->categoryService->tree();
    }
}
