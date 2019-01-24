<?php


namespace HMRC\Request;


use HMRC\Exceptions;
use HMRC\Oauth2\AccessToken;
use HMRC\Oauth2\Provider;
use HMRC\Request\Request;
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
        if ($this->accessToken->hasExpired()) {
            $this->refreshAccessToken();
        }

        return parent::fire();
    }

    /**
     * @throws Exceptions\InvalidEnvironmentException
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    private function refreshAccessToken()
    {
        $provider = Provider::newFromSession();
        $newToken = $provider->refreshToken();
        AccessToken::set($newToken);
    }

    protected function getHeaders()
    {
        return [
            parent::HEADER_ACCEPT => $this->getAcceptHeader(),
            parent::HEADER_AUTHORIZATION => $this->getAuthorizationHeader($this->accessToken),
        ];
    }
}
