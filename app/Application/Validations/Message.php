<?php

namespace App\Application\Validations;

use Illuminate\Validation\ValidationException;

/**
 * Class Message
 * @package App\Application\Validations
 */
class Message
{
    /**
     * @param string $message
     * @throws ValidationException
     */
    public static function execute(string $message)
    {
        throw ValidationException::withMessages([$message]);
    }
}
