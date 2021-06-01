<?php

namespace App\Infrastructure\Repositories;

interface  EntityRepositoryContract
{
    /**
     * Returns the class name of the object managed by the repository.
     *
     * @return string
     */
    public function getEntityClassName(): string;

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return mixed The object.
     */
    public function find($id);
}
