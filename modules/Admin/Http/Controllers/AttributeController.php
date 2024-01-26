<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Http\Requests\PaginationRequest;
use Modules\Product\Http\Requests\AttributeRequest;
use Modules\Product\Services\AttributeService;

class AttributeController extends Controller
{
    public function __construct(protected AttributeService $service)
    {
        $this->middleware("auth:admins");
    }
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        can_user('View Banners');

        $data = $request->validated();
        $id = $data["id"] ?? 0;
        return $this->service->getPaginate($id);
    }

    /**
     * Show the form for creating a new resource.
     * @return JsonResponse
     */
    public function create()
    {
        return success_response(true);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(AttributeRequest $request)
    {
        $data = $request->validated();
        return $this->service
                    ->add($data);
    }

    /**
     * Show the specified resource.
     * @param int $attribute
     * @return JsonResponse
     */
    public function show($attribute)
    {
        return $this->service->getById((int)$attribute);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $attribute
     * @return JsonResponse
     */
    public function edit($attribute)
    {
        return success_response($attribute);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $attribute
     * @return JsonResponse
     */
    public function update(AttributeRequest $request, $attribute)
    {
        $data = $request->validated();
        return $this->service
                    ->update($data, (int)$attribute);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get All attributes
     *
     * @return JsonResponse
     */
    public function getAll()
    {
        return $this->service->getAll();
    }
}
