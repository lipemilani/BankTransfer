<?php

namespace App\Domain\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DomainService
 * @package App\Domain\Services
 */
abstract class DomainService
{

    /**
     * Create a new registry in the database
     *
     * @param Model $model
     * @return Model
     */
    public function create(Model $model): Model
    {
        $model->created_at = Carbon::now()->setTimezone('UTC');
        $model->updated_at = Carbon::now()->setTimezone('UTC');
        $model->active = true;

        $model->save();

        return $model;
    }

    /**
     * Update a registry in the database
     *
     * @param Model $model
     * @return Model
     */
    public function update(Model $model): Model
    {
        $model->updated_at = Carbon::now()->setTimezone('UTC');

        $model->save();

        return $model;
    }

    /**
     * Remove a registry from the database
     *
     * @param Model $model
     */
    public function delete(Model $model)
    {
        $model->active = false;

        $model->save();
    }

    /**
     * Restore a registry from the database
     *
     * @param Model $model
     */
    public function restore(Model $model)
    {
        $model->active = true;

        $model->save();
    }
}
