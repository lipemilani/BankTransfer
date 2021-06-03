<?php

namespace App\Application\Validations;

use Illuminate\Validation\ValidationException;

class Message
{
    public static function execute(string $message)
    {
        throw ValidationException::withMessages([$message]);
    }
}
