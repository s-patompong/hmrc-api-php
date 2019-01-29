<?php


namespace HMRC\Hello;


use HMRC\Request\Request;

class HelloWorldRequest extends Request
{
    protected function getMethod(): string
    {
        return parent::METHOD_GET;
    }

    protected function getApiPath(): string
    {
        return '/hello/world';
    }
}
