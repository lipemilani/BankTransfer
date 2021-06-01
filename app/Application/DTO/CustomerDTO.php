<?php

namespace App\Application\DTO;

use Carbon\Carbon;

/**
 * Class CustomerDTO
 * @package App\Application\DTO
 */
class CustomerDTO extends DataTransferObject
{
    public ?string $id;

    public ?Carbon $createdAt;

    public ?Carbon $updatedAt;

    public ?bool $active;

    public ?string $name;

    public ?string $cpf;

    public ?string $email;

    public ?string $password;

    public ?float $balance;

    public ?int $type;

}
