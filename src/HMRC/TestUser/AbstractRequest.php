<?php

namespace HMRC\TestUser;

use HMRC\Request\RequestWithServerToken;
use HMRC\Request\RequestMethod;
use HMRC\Request\RequestHeader;
use HMRC\Request\RequestHeaderValue;

abstract class AbstractRequest extends RequestWithServerToken
{
    /** @var PostBody */
    protected $postBody;

    public function __construct(PostBody $postBody)
    {
        parent::__construct();

        $this->postBody = $postBody;
    }

    protected function getMethod(): string
    {
        return RequestMethod::POST;
    }

    protected function getHeaders(): array
    {
        $ownHeaders = [
            RequestHeader::CONTENT_TYPE => RequestHeaderValue::APPLICATION_JSON,
        ];

        return array_merge($ownHeaders, parent::getHeaders());
    }
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\InvalidPostBodyException
     * @throws \HMRC\Exceptions\MissingAccessTokenException
     *
     * @return mixed|Response
     */
    public function fire()
    {
        $this->postBody->validate();

        return parent::fire();
    }

    protected function getHTTPClientOptions(): array
    {
        return array_merge([
            'json' => $this->postBody->toArray(),
        ], parent::getHTTPClientOptions());
    }
}
