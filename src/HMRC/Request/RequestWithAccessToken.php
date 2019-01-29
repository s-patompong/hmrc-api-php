<?php


namespace HMRC\Request;


use HMRC\Exceptions;
use HMRC\Oauth2\AccessToken;
use HMRC\Oauth2\Provider;
use League\OAuth2\Client\Token\AccessTokenInterface;

abstract class RequestWithAccessToken extends Request
{
    /** @var AccessTokenInterface */
    protected $accessToken;

    public function __construct()
    {
        parent::__construct();

        $this->accessToken = AccessToken::get();
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws Exceptions\InvalidEnvironmentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function fire()
    {
        return parent::fire();
    }

    protected function getHeaders(): array
    {
        return [
            parent::HEADER_ACCEPT => $this->getAcceptHeader(),
            parent::HEADER_AUTHORIZATION => $this->getAuthorizationHeader($this->accessToken),
        ];
    }
}
