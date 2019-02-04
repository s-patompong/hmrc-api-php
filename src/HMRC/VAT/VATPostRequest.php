<?php

namespace HMRC\VAT;

use HMRC\Request\PostBody;
use HMRC\Request\RequestMethod;

abstract class VATPostRequest extends VATRequest
{
    /** @var PostBody */
    protected $postBody;

    public function __construct(string $vrn, PostBody $postBody)
    {
        parent::__construct($vrn);

        $this->postBody = $postBody;
    }

    protected function getMethod(): string
    {
        return RequestMethod::POST;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\InvalidPostBodyException
     * @throws \HMRC\Exceptions\MissingAccessTokenException
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
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
