<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Http\Requests\PaginationRequest;
use Modules\Payment\Http\Requests\PaymentTypeRequest;
use Modules\Payment\Services\PaymentTypeService;

class PaymentController extends Controller
{
    public function __construct(protected PaymentTypeService $service)
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
        return $this->service->getPaginate($id);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(PaymentTypeRequest $request)
    {
        $data = $request->validated();
        return $this->service->add($data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
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
     * @param int $id
     * @return Renderable
     */
    public function update(PaymentTypeRequest $request, int $payment)
    {
        $data = $request->validated();
        return $this->service->update($data, $payment);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $payment)
    {
        return $this->service->remove($payment);
    }
}
