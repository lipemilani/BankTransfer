<?php

namespace App\Http\Requests;

use App\Application\Validations\Customer\CheckDuplicity;
use Illuminate\Foundation\Http\FormRequest;

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
