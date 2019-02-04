<?php

namespace HMRC\Hello;

use HMRC\Request\RequestMethod;
use HMRC\Request\RequestWithAccessToken;

class HelloUserRequest extends RequestWithAccessToken
{
    protected function getMethod(): string
    {
        return RequestMethod::GET;
    }

    protected function getApiPath(): string
    {
        return '/hello/user';
    }
}
