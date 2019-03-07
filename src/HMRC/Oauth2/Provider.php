<?php

namespace HMRC\Oauth2;

use HMRC\Environment\Environment;
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
        $subDomain = Environment::getInstance()->isLive() ? 'api' : 'test-api';

        return [
            'urlAuthorize'            => "https://{$subDomain}.service.hmrc.gov.uk/oauth/authorize",
            'urlAccessToken'          => "https://{$subDomain}.service.hmrc.gov.uk/oauth/token",
            'urlResourceOwnerDetails' => "https://{$subDomain}.service.hmrc.gov.uk/oauth/resource",
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
