<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Rules\Transactions\CheckPayerType;

/**
 * Class TransactionRequest
 * @package App\Http\Requests
 */
class TransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = [
            'payer_id' => 'integer|required',
            'payee_id' => 'integer|required',
            'transaction_value' => 'numeric|required',
        ];

        $request['rules'] = new CheckPayerType(request()->all());

        return $request;

    }

}
