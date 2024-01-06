<?php

namespace Modules\Payment\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Modules\Common\Services\BaseService;
use Modules\Common\Services\FileService;
use Modules\Payment\Contracts\Repositories\IPaymentTypeRepository;
use Modules\Payment\Contracts\Repositories\IPaymentTypeSettingRepository;
use Modules\Payment\Transformers\PaymentTypeResource;

class PaymentTypeService extends BaseService
{
    public function __construct(private IPaymentTypeRepository $repository, private IPaymentTypeSettingRepository $settingRepository)
    {
    }

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);
        return $this->jsonSuccess([
            'data' => PaymentTypeResource::collection($data),
            'count' => $count
        ]);
    }

    public function add(array $data)
    {
        DB::beginTransaction();
        try {

            $settings = $data['settings'];
            // $image = $data['image'];
            unset($data['settings'], $data['image']);

            $paymentType = $this->repository->create($data);

            foreach ($settings as $setting) {
                $setting['payment_type_id'] = $paymentType->id;
                $this->settingRepository->create($setting);
            }

            DB::commit();
            return $this->jsonSuccess([]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function update(array $data, int $paymentId)
    {
        DB::beginTransaction();
        try {
            $paymentType = $this->repository->find($paymentId);
            abort_if(!$paymentType, 404, 'Payment Type not found');

            $settings = $data['settings'];
            unset($data['settings'], $data['image']);



            $paymentType->update($data);

            foreach ($settings as $setting) {
                $dbItem = $paymentType->settings->first(function ($value, int $key) use ($setting) {
                    return $value->id == $setting['id'];
                });
                if (!$dbItem) {
                    $dbItem->delete();
                } else {
                    $dbItem->update($setting);
                }
            }

            DB::commit();
            return $this->jsonSuccess([]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function remove(int $id)
    {
        DB::beginTransaction();
        try {
            $this->settingRepository->bulkyRemove($id);

            $payment = $this->repository->find($id);

            abort_if(!$payment, 404, "Payment type not found");

            $payment->delete();

            DB::commit();
            return $this->jsonSuccess(true);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }
}
