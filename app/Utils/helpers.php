<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Vite;

if (!function_exists('is_prod')) {
    /**
     * Checks if application in production mode.
     *
     * @return bool
     */
    function is_prod()
    {
        return app()->environment() !== 'local';
    }
}

if (!function_exists('success_response')) {
    /**
     * Json data wrapper for a success response to clients. Aimed for API applications. Returns Illuminate\Http\JsonResponse data wrapped with some meta data.
     *
     * @param [type] $data
     * @param int    $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    function success_response($data, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $code);
    }
}

if (!function_exists('error_response')) {
    /**
     * Json data wrapper for a error response to clients. Aimed for API applications. Returns Illuminate\Http\JsonResponse data wrapped with some meta data.
     *
     * @param string $message
     * @param int    $code
     * @param [type] $details
     *
     * @return Illuminate\Http\JsonResponse
     */
    function error_response($message = '', $code = 0, $details = null)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message,
        ];

        if (!is_prod()) {
            $response['details'] = $details;
        }

        return response()->json($response);
    }
}

if (!function_exists('checked_asset')) {
    function checked_asset(string $src)
    {
        $secure = \Illuminate\Support\Facades\App::environment('local') ? false : true;

        return asset($src, $secure);
    }
}

if (!function_exists('cleanNullArray')) {
    function cleanNullArray(array $originArray)
    {
        return array_filter($originArray, fn ($val) => !is_null($val));
    }
}

if (!function_exists('env_dependend_error')) {
    function env_dependend_error(string $message, string $prodMessage = 'Произошла ошибка сервера!')
    {
        Log::error('Environment dependent error: '.$message);

        return \Illuminate\Support\Facades\App::environment('local') ? $message : $prodMessage;
    }
}

if (!function_exists('storage_image')) {
    function storage_image(string|null $image, string $default = '/images/user.png') {
         return $image ? '/storage/' . $image : $default;
    }
}


if (!function_exists('name_input')) {
    function name_input(string $name, string $wrapper_start, string $wrapper_end = ']') {
        return $wrapper_start . $name . $wrapper_end;
    }
}

if (!function_exists('random_string')) {
    function random_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('short_hash')) {
    function short_hash(string $text = null) {
        return hash("crc32", !empty($text) ? $text : random_string(10));
    }
}

if (! function_exists('vite_load')) {
    /**
     * support for vite
     */
    function vite_load($module, $asset)
    {
        return Vite::useHotFile(storage_path($module.'.hot'))->useBuildDirectory($module)->withEntryPoints([...$asset]);
    }
}

if (!function_exists('can_user')) {
    function can_user($permissions, $model = null, $primaryKey = 'user_id', $guard = 'admins') {
        $user = auth($guard)->user();
        $errorMessage = 'Sizda bu amalni bajarishga ruxsat yo\'q';
        abort_if(!$user->can($permissions), 403, $errorMessage);

        abort_if($model && ($user->id !== $model->{$primaryKey}), 403, $errorMessage);
    }
}
