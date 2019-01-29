<?php


namespace HMRC\Oauth2;


use HMRC\Environment\Environment;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class Provider extends GenericProvider
{
    /** @var string live environment */
    const ENV_LIVE = 'LIVE';

    /** @var string sandbox environment */
    const ENV_SANDBOX = 'SANDBOX';

    /**
     * Provider constructor.
     *
     * @param string $clientID
     * @param string $clientSecret
     * @param string $callbackURI
     */
    public function __construct(string $clientID, string $clientSecret, string $callbackURI)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $options = array_merge([
            'clientId' => $clientID,
            'clientSecret' => $clientSecret,
            'redirectUri' => $callbackURI,
        ], $this->optionFromEnvironments());

        parent::__construct($options);
    }

    private function optionFromEnvironments(): array
    {
        $subDomain = Environment::getInstance()->isLive() ? 'api' : 'test-api';

        return [
            'urlAuthorize' => "https://{$subDomain}.service.hmrc.gov.uk/oauth/authorize",
            'urlAccessToken' => "https://{$subDomain}.service.hmrc.gov.uk/oauth/token",
            'urlResourceOwnerDetails' => "https://{$subDomain}.service.hmrc.gov.uk/oauth/resource",
        ];
    }

    public function redirectToAuthorizationURL(array $scopes)
    {
        $authorizationUrl = $this->getAuthorizationUrl([
            'scope' => implode(" ", $scopes),
        ]);

        header('Location: ' . $authorizationUrl);
        exit;
    }

    /**
     * @return \League\OAuth2\Client\Token\AccessTokenInterface
     * @throws \HMRC\Exceptions\InvalidVariableTypeException
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function refreshToken(): AccessTokenInterface
    {
        $newAccessToken = $this->getAccessToken('refresh_token', [
            'refresh_token' => AccessToken::get()->getRefreshToken(),
        ]);

        AccessToken::set($newAccessToken);

        return AccessToken::get();
    }
}
