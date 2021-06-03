<?php

namespace App\Application\Services;

use App\Domain\Services\DomainService;
use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;
use App\Application\Transformers\Transformer;
use App\Infrastructure\Repositories\EntityRepositoryContract;

/**
 * Class ApplicationService
 * @package App\Application\Services
 */
abstract class ApplicationService
{
    /**
     * @var DomainService|null
     */
    private ?DomainService $service;

    /**
     * @var Transformer|null
     */
    private ?Transformer $transformer;

    /**
     * @var EntityRepositoryContract|null
     */
    private ?EntityRepositoryContract $repository;

    /**
     * ApplicationService constructor.
     *
     * @param DomainService|null $service
     * @param Transformer|null $transformer
     */
    public function __construct(?DomainService $service = null, ?Transformer $transformer = null, ?EntityRepositoryContract $repository = null)
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }
    /**
     * @param DataTransferObject $dto
     * @return Model|null
     */
    public function store(DataTransferObject $dto): ?Model
    {
        $model = $this->transformer->toModel($dto);

        return $this->service->create($model);
    }

    /**
     * @param DataTransferObject $dto
     * @return Model|null
     */
    public function update(DataTransferObject $dto): ?Model
    {
        $model = $this->find(optional($dto)->id);

        if ($model === null) {
            return null;
        }

        $this->transformer->prepareForUpdate($model, $dto);

        return $this->service->update($model);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $model = $this->find($id);

        if ($model === null) {
            return false;
        }

        $this->service->delete($model);

        return true;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function restore(string $id): bool
    {
        $model = $this->find($id);

        if ($model === null) {
            return false;
        }

        $this->service->restore($model);

        return true;
    }
}
