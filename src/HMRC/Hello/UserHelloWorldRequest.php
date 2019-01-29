<?php


namespace HMRC\Hello;


use HMRC\Request\RequestWithAccessToken;

class UserHelloWorldRequest extends RequestWithAccessToken
{
    protected function getMethod(): string
    {
        return parent::METHOD_GET;
    }

    protected function getApiPath(): string
    {
        return '/hello/user';
    }
}
