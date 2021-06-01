<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Models\Customer;
use App\Application\DTO\CustomerDTO;
use App\Http\Requests\CustomerRequest;
use App\Application\Services\CustomerApplicationService;

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
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
    public function store(CustomerRequest $request)
    {
        $dto = CustomerDTO::fromRequest($request);

        $result = $this->service->store($dto);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->service->find($id);

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
    public function update(CustomerRequest $request, $id)
    {
        $dto = CustomerDTO::fromRequest($request);
        $dto->id = $id;

        $customer = $this->service->update($dto);

        return response()->json($customer);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy($id)
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
    public function restore($id)
    {
        $this->service->restore($id);

        return response(null, 204);
    }
}
