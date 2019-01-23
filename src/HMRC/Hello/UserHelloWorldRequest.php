<?php


namespace HMRC\Hello;


use HMRC\Request\RequestWithAccessToken;

class UserHelloWorldRequest extends RequestWithAccessToken
{
    protected function getMethod()
    {
        return parent::METHOD_GET;
    }

    protected function getApiPath()
    {
        return '/hello/user';
    }
}
