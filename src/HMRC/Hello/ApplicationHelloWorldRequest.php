<?php


namespace HMRC\Hello;


use HMRC\Request;

class ApplicationHelloWorldRequest extends Request
{
    private $serverToken;

    public function __construct(string $serverToken)
    {
        parent::__construct();

        $this->serverToken = $serverToken;
    }

    function getMethod()
    {
        return parent::METHOD_GET;
    }

    function getApiPath()
    {
        return '/hello/application';
    }

    function getHeaders()
    {
        return [
            parent::HEADER_ACCEPT => $this->getAcceptHeader(),
            parent::HEADER_AUTHORIZATION => $this->getAuthorizationHeader($this->serverToken),
        ];
    }
}
