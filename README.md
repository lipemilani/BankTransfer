## About

Projeto desenvolvido em Laravel que simula transfêrencia de valores entre usuários comuns e lojistas.

## Requirements

- [x] **PHP 7.4** </br>
- [x] **Banco de dados MYSQL** </br>
- [x] **Git** </br>
- [x] **Composer** </br>

## Getting started
```
~ git clone https://github.com/lipemilani/BankTransfer.git
```
## Installation

- Criar o arquivo .env de acordo com o .env.example
- Ajustar as configurações de acesso ao banco de dados no .env
- Rodar os seguintes comandos: php artisan migrate / composer install

## Usage

- Inicialmente precisamos criar 2 usuários/clientes:

**POST /customers** </br>
payload: </br>
{ </br>
&nbsp;&nbsp;&nbsp; "name": "", </br>
&nbsp;&nbsp;&nbsp; "cpf": "", </br>
&nbsp;&nbsp;&nbsp; "email": "", </br>
&nbsp;&nbsp;&nbsp; "password": "", </br>
&nbsp;&nbsp;&nbsp; "balance": "", </br>
&nbsp;&nbsp;&nbsp; "type": 1 ou 2 **(1 para clientes comuns e 2 para lojistas)** </br>
} </br>

- Após criado os usuários/lojistas, vamos criar uma transação entre eles:

**POST /transactions** </br>
payload: </br>
{ </br>
&nbsp;&nbsp;&nbsp; "payer_id": 1, </br>
&nbsp;&nbsp;&nbsp; "payee_id": 2, </br>
&nbsp;&nbsp;&nbsp; "transaction_value": 100.00 </br>
}
