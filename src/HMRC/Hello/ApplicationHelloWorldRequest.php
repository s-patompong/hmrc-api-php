<?php


namespace HMRC\Hello;


use HMRC\Request\RequestWithServerToken;

class ApplicationHelloWorldRequest extends RequestWithServerToken
{
    protected function getMethod()
    {
        return parent::METHOD_GET;
    }

    protected function getApiPath()
    {
        return '/hello/application';
    }
}
