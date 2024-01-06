<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Shipping\Services\ShippingService;
use Modules\Common\Http\Requests\PaginationRequest;
use Modules\Shipping\Http\Requests\StoreShippingRequest;

class ShippingController extends Controller
{
    public function __construct(protected ShippingService $shippingService)
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
        return $this->shippingService->getPaginate($id);
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
    public function store(StoreShippingRequest $request)
    {
        $data = $request->validated();

        return $this->shippingService->add($data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return mixed
     */
    public function show($shipping)
    {
        can_user('View Category');
        return $this->shippingService->getById((int)$shipping);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return mixed
     */
    public function edit($shipping)
    {
        return $shipping;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(StoreShippingRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return mixed
     */
    public function destroy($shipping)
    {
        //
    }

    public function all()
    {
        return $this->shippingService->getAll();
    }
}
