<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Domain\Models
 *
 * @property string $id
 * @property string $payer_id
 * @property string $payee_id
 * @property string $transaction_value
 * @property bool   $is_success
 */
class Transaction extends Model
{
    /**
     * @var string
     */
    protected $table = 'transactions';

    public $timestamps = false;


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'payer_id' => 'integer',
        'payee_id' => 'integer',
        'transaction_value' => 'float',
        'is_success' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'payer_id',
        'payee_id',
        'transaction_value',
        'is_success'
    ];
}
