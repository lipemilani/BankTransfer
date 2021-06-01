<?php

namespace App\Infrastructure\Repositories;

/**
 * Class EntityRepository
 * @package App\Infrastructure\Repositories
 */
class EntityRepository implements EntityRepositoryContract
{

    protected string $entityClassName;

    /**
     * @inheritDoc
     */
    public function getEntityClassName(): string
    {
        return $this->entityClassName;
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
        return $this->getEntityClassName()::find($id);
    }
}
