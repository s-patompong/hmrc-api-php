<?php


namespace HMRC\Hello;


use HMRC\Request;

class UserHelloWorldRequest extends Request
{
    private $accessToken;

    public function __construct(string $accessToken)
    {
        parent::__construct();

        $this->accessToken = $accessToken;
    }

    function getHeaders()
    {
        return [
            parent::HEADER_ACCEPT => $this->getAcceptHeader(),
            parent::HEADER_AUTHORIZATION => $this->getAuthorizationHeader($this->accessToken),
        ];
    }

    function getMethod()
    {
        return parent::METHOD_GET;
    }

    function getApiPath()
    {
        return '/hello/user';
    }
}
