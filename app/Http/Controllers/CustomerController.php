<?php

namespace App\Http\Controllers;

use App\Application\DTO\CustomerDTO;
use Illuminate\Http\Request;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
    public function store(Request $request)
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
    public function update(Request $request, $id)
    {
        $dto = CustomerDTO::fromRequest($request);
        $dto->id = $id;

        $customer = $this->service->update($dto);

        return response()->json($customer);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->service->delete($id);

        return response()->json($result);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $result = $this->service->restore($id);

        return response()->json($result);
    }
}
