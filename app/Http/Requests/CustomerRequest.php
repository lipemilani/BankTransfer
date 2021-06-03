<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Rules\Customers\CheckDuplicity;

/**
 * Class CustomerRequest
 * @package App\Http\Requests
 */
class CustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->method() === 'POST') {
            return $this->store();
        }

        if (request()->method() === 'PUT') {
            return $this->update();
        }

    }

    /**
     * @return string[]
     */
    private function store()
    {
        $request = [
            'name' => 'string|required',
            'cpf' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|required',
            'balance' => 'numeric|nullable',
            'type' => 'integer|required',
        ];

        $request['rules'] = new CheckDuplicity(request()->all());

        return $request;
    }

    /**
     * @return string[]
     */
    private function update()
    {
        return [
            'name' => 'string',
            'cpf' => 'string',
            'email' => 'string',
            'password' => 'string',
            'balance' => 'numeric|nullable',
            'type' => 'integer',
        ];
    }
}
