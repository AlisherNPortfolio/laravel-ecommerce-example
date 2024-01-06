<?php

namespace Modules\TaxRule\Services;

use Exception;
use Modules\Common\Services\BaseService;
use Modules\TaxRule\Contracts\Repositories\ITaxRuleRepository;
use Modules\TaxRule\Transformers\TaxRuleResource;

class TaxRuleService extends BaseService
{
    public function __construct(private ITaxRuleRepository $repository)
    {
    }

    public function getAll()
    {
        try {
            $taxRules = $this->repository->all();

            return $this->jsonSuccess(TaxRuleResource::collection($taxRules));
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function getPaginate($id, $perPage = 15)
    {
        [$data, $count] = $this->repository->getPagination($id, $perPage);
        return $this->jsonSuccess([
            'data' => TaxRuleResource::collection($data),
            'count' => $count]
        );
    }

    public function getById($id)
    {
        $taxRule = $this->repository->find($id);
        abort_if(!$taxRule, 404, "Tax rule not found!");

        return $this->jsonSuccess($taxRule);
    }

    public function add(array $data)
    {
        try {
            $this->repository->create($data);

            return $this->jsonSuccess(['message' => "Created!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function update(array $data, int|string $id)
    {
        try {
            $taxRule = $this->repository->find($id);
            abort_if(!$taxRule, 404, "Tax rule not found");

            $taxRule->update($data);

            return $this->jsonSuccess(['message' => "Updated!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }

    public function delete(int $id)
    {
        try {
            $this->repository->delete($id);
            return $this->jsonSuccess(["message"=> "Deleted!"]);
        } catch (Exception $e) {
            return $this->jsonError(
                env_dependend_error($e->getMessage())
            );
        }
    }
}
