<?php

namespace HMRC\Request;

use HMRC\Exceptions\MissingAccessTokenException;
use HMRC\Oauth2\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

abstract class RequestWithAccessToken extends Request
{
    /** @var AccessTokenInterface */
    protected $accessToken;

    /**
     * RequestWithAccessToken constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->accessToken = AccessToken::get();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws MissingAccessTokenException
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function fire()
    {
        if (is_null($this->accessToken)) {
            throw new MissingAccessTokenException();
        }

        return parent::fire();
    }

    protected function getHeaders(): array
    {
        return array_merge([
            RequestHeader::AUTHORIZATION => $this->getAuthorizationHeader($this->accessToken),
        ], parent::getHeaders());
    }
}
