<?php

namespace Modules\Common\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Common\Http\Requests\DeleteFileRequest;
use Modules\Common\Http\Requests\UploadFileRequest;
use Modules\Common\Http\Requests\UploadImageRequest;
use Modules\Common\Services\FileService;

class FileController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->middleware('auth:admins', ['except' => ['customerUpload']]);
        $this->service = new FileService();
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $data = $request->validated();

        return $this->upload($data['files'], $data['path']);
    }

    public function uploadImage(UploadImageRequest $request)
    {
        $data = $request->validated();

        return $this->upload($data['images'], $data['path']);
    }

    public function deleteFile(DeleteFileRequest $request)
    {
        try {
            $data = $request->validated();

            foreach ($data as $path) {
                $this->service->delete($path);
            }

            return success_response(true);
        } catch (Exception $e) {
            return error_response(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function deleteImage(DeleteFileRequest $request)
    {
        try {
            $data = $request->validated();

            foreach ($data['paths'] as $path) {
                $this->service->delete($path);
            }

            return success_response('Deleted successfully');
        } catch (Exception $e) {
            return error_response(
                env_dependend_error($e->getMessage())
            );
        }
    }

    private function upload(array $files, string $path): JsonResponse
    {
        return success_response(
            $this->service->saveFiles($files, $path)
        );
    }
}
