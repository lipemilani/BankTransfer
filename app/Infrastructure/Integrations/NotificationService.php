<?php

namespace App\Infrastructure\Integrations;

use Httpful\Request as Request;

class NotificationService
{
    /**
     * @var string
     */
    protected string $protocol;

    /**
     * @var string
     */
    protected string $apiUrl;

    /**
     * @var string
     */
    protected string $apiEndPoint;

    /**
     * AuthorizationService constructor.
     */
    public function __construct()
    {
        $this->protocol = 'http';
        $this->apiUrl = 'o4d9z.mocklab.io/notify';

        $this->apiEndPoint = $this->protocol . '://' . $this->apiUrl;
    }

    /**
     * @return bool
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function send()
    {
        $result = Request::get($this->apiEndPoint)->send();

        if ($result->code !== 200) {
            return false;
        }

        return true;
    }
}
