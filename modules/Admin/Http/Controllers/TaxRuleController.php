<?php

namespace Modules\Admin\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Http\Requests\PaginationRequest;
use Modules\TaxRule\Http\Requests\TaxRuleRequest;
use Modules\TaxRule\Services\TaxRuleService;

class TaxRuleController extends Controller
{
    public function __construct(protected TaxRuleService $taxRuleService)
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
        return $this->taxRuleService->getPaginate($id);
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
    public function store(TaxRuleRequest $request)
    {
        $data = $request->validated();

        return $this->taxRuleService->add($data);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return mixed
     */
    public function show($taxRule)
    {
        can_user('View Category');
        return $this->taxRuleService->getById((int)$taxRule);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return mixed
     */
    public function edit($taxRule)
    {
        return $taxRule;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(TaxRuleRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return mixed
     */
    public function destroy($taxRule)
    {
        //
    }

    public function all()
    {
        return $this->taxRuleService->getAll();
    }
}
