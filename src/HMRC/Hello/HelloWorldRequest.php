<?php

namespace HMRC\Hello;

use HMRC\Request\Request;
use HMRC\Request\RequestMethod;

class HelloWorldRequest extends Request
{
    protected function getMethod(): string
    {
        return RequestMethod::GET;
    }

    protected function getApiPath(): string
    {
        return '/hello/world';
    }
}
