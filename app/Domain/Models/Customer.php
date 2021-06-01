<?php

namespace App\Domain\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * @package App\Domain\Models
 *
 * @property string $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $active
 * @property string $name
 * @property string $cpf
 * @property string $email
 * @property string $password
 * @property string $balance
 * @property string $type
 */
class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @inheritdoc
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'active' => 'boolean',
        'name' => 'string',
        'cpf' => 'string',
        'email' => 'string',
        'password' => 'string',
        'balance' => 'float',
        'type' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'active',
        'name',
        'cpf',
        'email',
        'password',
        'balance',
        'type'
    ];
}
