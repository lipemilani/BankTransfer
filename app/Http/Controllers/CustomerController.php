<?php

namespace App\Http\Controllers;

use App\Domain\Models\Customer;
use App\Application\DTO\CustomerDTO;
use App\Http\Requests\CustomerRequest;
use App\Application\Services\CustomerApplicationService;
use App\Http\Transformers\Customers\CustomerTransformer;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{

    /**
     * CustomerController constructor.
     * @param CustomerApplicationService $service
     */
    public function __construct(CustomerApplicationService $service)
    {
        parent::__construct($service);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = Customer::paginate(15);

        return response()->json($result);
    }

    /**
     * @param CustomerRequest $request
     * @return array
     * @throws \ReflectionException
     */
    public function store(CustomerRequest $request): array
    {
        $dto = CustomerDTO::fromRequest($request);

        /**
         * @var Customer $customer
         */
        $customer = $this->service->store($dto);

        return (new CustomerTransformer)->transform($customer);
    }

    /**
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        /**
         * @var Customer $customer
         */
        $customer = $this->service->find($id);

        return (new CustomerTransformer)->transform($customer);
    }

    /**
     * @param CustomerRequest $request
     * @param $id
     * @return array
     * @throws \ReflectionException
     */
    public function update(CustomerRequest $request, $id): array
    {
        $dto = CustomerDTO::fromRequest($request);
        $dto->id = $id;

        /**
         * @var Customer $customer
         */
        $customer = $this->service->update($dto);

        return (new CustomerTransformer)->transform($customer);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): \Illuminate\Http\Response
    {
        $this->service->delete($id);

        return response(null, 204);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id): \Illuminate\Http\Response
    {
        $this->service->restore($id);

        return response(null, 204);
    }
}
