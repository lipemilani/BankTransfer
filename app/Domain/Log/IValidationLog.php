<?php

namespace App\Domain\Log;

/**
 * Interface IValidationLog
 * @package App\Domain\Log
 */
interface IValidationLog
{
    /**
     * @param string $message
     * @return static
     */
    public static function send(string $message): self;
}
