<?php

namespace Modules\Admin\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Common\Services\BaseService;
use Modules\User\Contracts\Repositories\IUserRepository;
use Modules\User\Models\Admin;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends BaseService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Auth service method.
     *
     * @param array $data validated data from UI
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(array $data)
    {
        try {
            $user = Admin::query()
                        ->where('email', '=', $data['email'])
                        ->first();

            abort_if(!$user, 404, 'Bunday elektron manzilli foydalanuvchi topilmadi!');

            $credentials = [
                'email' => $data['email'],
                'password' => $data['password'],
            ];

            if (!$token = auth('admins')->attempt($credentials)) {
                return $this->jsonError('Parol xato!');
            }

            return $this->respondWithToken($token);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage()),
            );
        }
    }

    public function register(array $data)
    {
        $user = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->jsonSuccess([
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function getaccount($guard = 'admins')
    {
        return $this->jsonSuccess([
            'user' => auth($guard)->user(),
        ]);
    }

    public function logout($guard = 'admins')
    {
        auth($guard)->logout();

        return $this->jsonSuccess([
            'message' => 'Success',
        ]);
    }

    protected function respondWithToken($token, $guard = 'admins')
    {
        $auth = Auth::guard($guard);

        return $this->jsonSuccess([
            'token' => $token,
            'token_type' => 'bearer',
            'permissions' => $auth->user()->permissions->toArray(),
            'expire_time' => $auth->factory()->getTTL() * 60,
        ]);
    }
}
