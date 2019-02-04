<?php

namespace HMRC\Request;

abstract class RequestHeader
{
    /** @var string content type for request */
    public const CONTENT_TYPE = 'Content-Type';

    /** @var string accept header for request */
    public const ACCEPT = 'Accept';

    /** @var string authorization header for request */
    public const AUTHORIZATION = 'Authorization';
}
