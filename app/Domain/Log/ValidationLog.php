<?php

namespace App\Domain\Log;

use Illuminate\Validation\ValidationException;

/**
 * Class ValidationLog
 * @package App\Domain\Log
 */
class ValidationLog implements IValidationLog
{

    /**
     * @param string $message
     * @return IValidationLog
     * @throws ValidationException
     */
    public static function send(string $message): IValidationLog
    {
        throw ValidationException::withMessages([$message]);
    }
}
