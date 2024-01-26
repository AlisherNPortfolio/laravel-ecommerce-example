<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\BannerRequest;
use Modules\Banners\Models\Banner;
use Modules\Banners\Services\BannerService;
use Modules\Common\Http\Controllers\Controller;
use Modules\Common\Http\Requests\PaginationRequest;

class BannerController extends Controller
{

    public function __construct(protected BannerService $service)
    {
        $this->middleware('auth:admins');
    }

    public function index(PaginationRequest $request)
    {
        can_user('View Banners');

        $data = $request->validated();
        $id = $data["id"] ?? 0;
        return $this->service->pagination($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        can_user('Store Banners');
        if ($request->isMethod('POST')) {
            $data = $request->validated();
            return $this->service->create($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $banner)
    {
        can_user('View Banners');
        return $this->service->getOne((int)$banner, ['banners']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, string $banner)
    {
        can_user('Update Banners');
        $data = $request->validated();
        $banner = (int)$banner;

        return $this->service->update($data, $banner);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        can_user('Delete Banners');
        return $this->service->delete($banner);
    }

    public function removeItem(Request $request, int $item_id)
    {
        can_user('Delete Banners');
        return $this->service->removeItem($item_id);
    }
}
