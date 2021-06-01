<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;
use Illuminate\Support\Facades\Request;

/**
 * Class Transformer
 * @package App\Application\Transformers
 */
abstract class Transformer
{
    /**
     * @param DataTransferObject $dto
     * @return Model
     */
    public abstract function toModel(DataTransferObject $dto): Model;

    /**
     * @param Model $model
     * @param DataTransferObject $dto
     * @return mixed
     */
    public abstract function prepareForUpdate(Model &$model, DataTransferObject $dto);

    /**
     * @param array $attributes
     * @param Model $entity
     * @return array
     */
    protected function getResult(array $attributes, Model $entity)
    {
        $fields = array_filter(explode(',', Request::input('fields.' . $entity->getTable())));

        if (blank($fields)) {
            return $attributes;
        }

        $fields = array_unique(array_merge($fields, [$entity->getKeyName()]));

        return array_filter($attributes, fn($key) => in_array($key, $fields), ARRAY_FILTER_USE_KEY);
    }
}
