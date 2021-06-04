<?php

namespace App\Http\Transformers\Transactions;

use App\Domain\Models\Transaction;
use League\Fractal\TransformerAbstract;

/**
 * Class TransactionTransformer
 * @package App\Http\Transformers\Transactions
 */
class TransactionTransformer extends TransformerAbstract
{
    /**
     * @param Transaction $transaction
     * @return array
     */
    public function transform(Transaction $transaction): array
    {
        return [
            'id' => $transaction->id,
            'payer_id' => $transaction->payer_id,
            'payee_id' => $transaction->payee_id,
            'transaction_value' => $transaction->transaction_value,
            'is_success' => $transaction->is_success
        ];
    }
}
