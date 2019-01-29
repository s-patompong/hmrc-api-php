<?php


namespace HMRC\Hello;


use HMRC\Request\RequestWithServerToken;

class HelloApplicationRequest extends RequestWithServerToken
{
    protected function getMethod(): string
    {
        return parent::METHOD_GET;
    }

    protected function getApiPath(): string
    {
        return '/hello/application';
    }
}
