<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Application\Services\ApplicationService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var ApplicationService
     */
    protected ApplicationService $service;

    /**
     * Controller constructor.
     * @param ApplicationService $service
     */
    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }
}
