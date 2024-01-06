<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\LoginRequest;
use Modules\Admin\Http\Requests\RegisterRequest;
use Modules\Admin\Services\AuthService;
use Modules\Common\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:admins', ['except' => ['login', 'register']]);
        $this->service = $authService;
    }

    public function login(LoginRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->validated();

            return $this->service->login($data);
        }
    }

    public function register(RegisterRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->validated();

            return $this->service->register($data);
        }
    }

    public function me()
    {
        return $this->service->getaccount();
    }

    public function logout()
    {
        return $this->service->logout();
    }

    public function reloadCaptcha()
    {
        // abort_if(Auth::check(), 403, 'Forbidden');

        return response()->json(['captcha' => captcha_img()]);
    }

    // public function checkRecaptcha(CaptchaRequest $request)
    // {
    //     // abort_if(Auth::check(), 403, 'Forbidden');

    //     try {
    //         $request->validated();

    //         return response()->json(true);
    //     } catch (\Exception $e) {
    //         return response()->json(false);
    //     }
    // }
}
