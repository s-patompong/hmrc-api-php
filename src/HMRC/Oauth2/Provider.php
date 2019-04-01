<?php

namespace HMRC\Oauth2;

use HMRC\Environment\Environment;
use HMRC\Request\RequestURL;
use League\OAuth2\Client\Provider\GenericProvider;

class Provider extends GenericProvider
{
    /**
     * Provider constructor.
     *
     * @param string $clientID
     * @param string $clientSecret
     * @param string $callbackURI
     */
    public function __construct(string $clientID, string $clientSecret, string $callbackURI)
    {
        $options = array_merge([
            'clientId'     => $clientID,
            'clientSecret' => $clientSecret,
            'redirectUri'  => $callbackURI,
        ], $this->optionFromEnvironments());

        parent::__construct($options);
    }

    /**
     * Returns the string that should be used to separate scopes when building
     * the URL for requesting an access token.
     *
     * @return string Scope separator, defaults to ','
     */
    protected function getScopeSeparator()
    {
        return ' ';
    }

    private function optionFromEnvironments(): array
    {
        $host = Environment::getInstance()->isLive() ? RequestURL::LIVE : RequestURL::SANDBOX;

        return [
            'urlAuthorize'            => "{$host}/oauth/authorize",
            'urlAccessToken'          => "{$host}/oauth/token",
            'urlResourceOwnerDetails' => "{$host}/oauth/resource",
        ];
    }

    public function redirectToAuthorizationURL(array $scopes)
    {
        $authorizationUrl = $this->getAuthorizationUrl([
            'scope' => $scopes,
        ]);

        header('Location: '.$authorizationUrl);
        exit;
    }
}
