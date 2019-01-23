<?php


namespace HMRC\Hello;


use HMRC\Request;

class HelloWorldRequest extends Request
{
    function getMethod()
    {
        return parent::METHOD_GET;
    }

    function getApiPath()
    {
        return '/hello/world';
    }

    function getHeaders()
    {
        return [
            parent::HEADER_ACCEPT => $this->getAcceptHeader(),
        ];
    }
}
