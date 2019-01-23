<?php


namespace HMRC\Hello;


use HMRC\Request\Request;

class HelloWorldRequest extends Request
{
    protected function getMethod()
    {
        return parent::METHOD_GET;
    }

    protected function getApiPath()
    {
        return '/hello/world';
    }
}
