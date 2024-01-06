<?php

namespace Theme\Default\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Cart\Http\Requests\CartRequest;
use Modules\Common\Http\Requests\PaginationRequest;
use Theme\Default\Services\ThemeCartService;

class CartController extends Controller
{
    public function __construct(protected ThemeCartService $service)
    {
        // $this->middleware('auth:api');
    }

    public function index(PaginationRequest $request)
    {
        $data = $request->validated();
        $id = $data["id"] ?? 0;
        return $this->service->getPaginate($id);
    }

    public function store(CartRequest $request)
    {
        $data = $request->validated();
        return $this->service->add($data);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
