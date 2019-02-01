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
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws MissingAccessTokenException
     */
    public function fire()
    {
        if(is_null($this->accessToken)) {
            throw new MissingAccessTokenException;
        }

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
