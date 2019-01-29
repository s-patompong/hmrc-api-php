<?php


namespace HMRC\Hello;


use HMRC\Request\RequestWithAccessToken;

class HelloUserRequest extends RequestWithAccessToken
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
