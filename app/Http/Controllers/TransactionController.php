<?php

namespace App\Http\Controllers;

use App\Domain\Models\Transaction;
use App\Application\DTO\TransactionDTO;
use App\Http\Requests\TransactionRequest;
use App\Application\Services\TransactionApplicationService;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{

    /**
     * TransactionController constructor.
     * @param TransactionApplicationService $service
     */
    public function __construct(TransactionApplicationService $service)
    {
        parent::__construct($service);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = Transaction::paginate(15);

        return response()->json($result);
    }

    /**
     * @param TransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
    public function store(TransactionRequest $request)
    {
        $dto = TransactionDTO::fromRequest($request);

        $result = $this->service->store($dto);

        return response()->json($result);
    }
}
