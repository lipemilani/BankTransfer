<?php

namespace App\Application\Transformers;

use App\Domain\Models\Transaction;
use App\Application\DTO\TransactionDTO;
use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;

/**
 * Class TransactionTransformer
 * @package App\Application\Transformers
 */
class TransactionTransformer extends Transformer
{
    /**
     * @param TransactionDTO|DataTransferObject $dto
     * @return Transaction
     */
    public function toModel(DataTransferObject $dto): Transaction
    {
        $transaction = new Transaction();

        $transaction->id = $dto->id;
        $transaction->payer_id = $dto->payerId;
        $transaction->payee_id = $dto->payeeId;
        $transaction->transaction_value = $dto->transactionValue;
        $transaction->is_success = $dto->isSuccess;

        return $transaction;
    }

    /**
     * @param Transaction|Model $model
     * @param TransactionDTO|DataTransferObject $dto
     * @return mixed|void
     */
    public function prepareForUpdate(Model &$model, DataTransferObject $dto)
    {
        !array_key_exists('payer_id', $dto->requestData) ?: $model->payer_id = $dto->payerId;
        !array_key_exists('payee_id', $dto->requestData) ?: $model->payee_id = $dto->payeeId;
        !array_key_exists('transaction_value', $dto->requestData) ?: $model->transaction_value = $dto->transactionValue;
        !array_key_exists('is_success', $dto->requestData) ?: $model->is_success = $dto->isSuccess;
    }
}
