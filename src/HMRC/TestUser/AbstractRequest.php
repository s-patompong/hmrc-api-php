<?php

namespace HMRC\TestUser;

use HMRC\Request\RequestHeader;
use HMRC\Request\RequestHeaderValue;
use HMRC\Request\RequestMethod;
use HMRC\Request\RequestWithServerToken;

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
        return array_merge(parent::getHeaders(), [
            RequestHeader::CONTENT_TYPE => RequestHeaderValue::APPLICATION_JSON,
        ]);
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
