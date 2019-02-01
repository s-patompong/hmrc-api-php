<?php


namespace HMRC\Request;


abstract class RequestURL
{
    /** @var string URL of sandbox environment */
    public const SANDBOX = 'https://test-api.service.hmrc.gov.uk';

    /** @var string URL of live environment */
    public const LIVE = 'https://api.service.hmrc.gov.uk';
}
