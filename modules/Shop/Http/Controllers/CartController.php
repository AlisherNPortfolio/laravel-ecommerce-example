<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Services\CartService;
use Modules\Common\Http\Requests\PaginationRequest;

class CartController extends Controller
{
    public function __construct(protected CartService $service)
    {
        // $this->middleware('auth:admins');
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        can_user('View Cart');

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
        return 1;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        return 1;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        //
    }
}
