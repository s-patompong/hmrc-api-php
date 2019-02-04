<?php

namespace HMRC\Hello;

use HMRC\Request\RequestMethod;
use HMRC\Request\RequestWithServerToken;

class HelloApplicationRequest extends RequestWithServerToken
{
    protected function getMethod(): string
    {
        return RequestMethod::GET;
    }

    protected function getApiPath(): string
    {
        return '/hello/application';
    }
}
