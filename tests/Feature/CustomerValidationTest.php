<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * Class CustomerValidationTest
 * @package Tests\Feature
 */
class CustomerValidationTest extends TestCase
{
    use WithFaker;

    public function test_email_check_exist()
    {
        $result = $this->json('POST','/api/customers', [
            'name' => $this->faker->firstName,
            'cpf' => $this->faker->numerify('###########'),
	        'email' => 'lojista1@picpay.com',
	        'password' => $this->faker->password,
	        'balance' => '100',
	        'type' => 2
        ]);

        $result->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'rules' => [
                    'E-mail já existe.'
                ]
            ]
        ]);
    }

    public function test_cpf_check_exist()
    {
        $result = $this->json('POST','/api/customers', [
            'name' => $this->faker->firstName,
            'cpf' => '73127860064',
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'balance' => '100',
            'type' => 2
        ]);

        $result->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'rules' => [
                    'Cpf já existe.'
                ]
            ]
        ]);
    }

    public function test_check_if_payer_exist()
    {
        $result = $this->json('POST','/api/transactions', [
            'payer_id' => 100,
            'payee_id' => 3,
            'transaction_value' => 20
        ]);

        $result->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'rules' => [
                    'Pagador não existe.'
                ]
            ]
        ]);
    }

    public function test_check_if_payee_not_exist()
    {
        $result = $this->json('POST','/api/transactions', [
            'payer_id' => 1,
            'payee_id' => 300,
            'transaction_value' => 20
        ]);

        $result->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'rules' => [
                    'Beneficiário não existe.'
                ]
            ]
        ]);
    }

    public function test_check_if_payer_type_is_shopkeeper()
    {
        $result = $this->json('POST','/api/transactions', [
            'payer_id' => 3,
            'payee_id' => 1,
            'transaction_value' => 20
        ]);

        $result->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'rules' => [
                    'Lojistas não podem efetuar transferências!'
                ]
            ]
        ]);
    }
}
