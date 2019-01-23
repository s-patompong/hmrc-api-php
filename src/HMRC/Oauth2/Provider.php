<?php


namespace HMRC\Oauth2;


use HMRC\Exceptions\InvalidEnvironmentException;
use League\OAuth2\Client\Provider\GenericProvider;

class Provider extends GenericProvider
{
    /** @var string live environment */
    const ENV_LIVE = 'LIVE';

    /** @var string sandbox environment */
    const ENV_SANDBOX = 'SANDBOX';

    /**
     * Provider constructor.
     *
     * @param string $environment
     * @param array $options
     * @param array $collaborators
     *
     * @throws InvalidEnvironmentException
     */
    public function __construct(string $environment, string $clientID, string $clientSecret, string $callbackURI, string $callerURL, array $collaborators = [])
    {
        if (!in_array($environment, [ static::ENV_LIVE, static::ENV_SANDBOX ])) {
            throw new InvalidEnvironmentException("Invalid environment, accept only " . static::ENV_LIVE . " and " . static::ENV_SANDBOX . ".");
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $options = array_merge([
            'clientId' => $clientID,
            'clientSecret' => $clientSecret,
            'redirectUri' => $callbackURI,
        ], $this->optionFromEnvironments($environment));

        $_SESSION[ 'environment' ] = $environment;
        $_SESSION[ 'client_id' ] = $clientID;
        $_SESSION[ 'client_secret' ] = $clientSecret;
        $_SESSION[ 'redirect_uri' ] = $callbackURI;
        $_SESSION[ 'caller' ] = $callerURL;

        parent::__construct($options, $collaborators);
    }

    private function optionFromEnvironments(string $environment)
    {
        $subDomain = $environment == static::ENV_LIVE ? 'api' : 'test-api';

        return [
            'urlAuthorize' => "https://{$subDomain}.service.hmrc.gov.uk/oauth/authorize",
            'urlAccessToken' => "https://{$subDomain}.service.hmrc.gov.uk/oauth/token",
            'urlResourceOwnerDetails' => "https://{$subDomain}.service.hmrc.gov.uk/oauth/resource",
        ];
    }

    public function redirectToAuthorizationURL(array $scope)
    {
        $authorizationUrl = $this->getAuthorizationUrl([
            'scope' => $scope,
        ]);

        header('Location: ' . $authorizationUrl);
        exit;
    }

    /**
     * @return Provider
     * @throws InvalidEnvironmentException
     */
    public static function newFromSession()
    {
        return new static(
            $_SESSION[ 'environment' ],
            $_SESSION[ 'client_id' ],
            $_SESSION[ 'client_secret' ],
            $_SESSION[ 'redirect_uri' ],
            $_SESSION[ 'caller' ]
        );
    }

    public function redirectToCaller()
    {
        header('Location: ' . $_SESSION[ 'caller' ]);
        exit;
    }

    /**
     * @return \League\OAuth2\Client\Token\AccessTokenInterface
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function refreshToken()
    {
        return $this->getAccessToken('refresh_token', [
            'refresh_token' => AccessToken::get()->getRefreshToken(),
        ]);
    }

    /**
     * @throws InvalidEnvironmentException
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public static function saveAccessTokenAndRedirectBackToCaller()
    {
        // Get provider from session
        $provider = \HMRC\Oauth2\Provider::newFromSession();

        // Get access token from response URL and save it in access token session
        \HMRC\Oauth2\AccessToken::set($provider->getAccessTokenFromResponse());

        // Redirect back to caller
        $provider->redirectToCaller();
    }

    /**
     * @return \League\OAuth2\Client\Token\AccessTokenInterface
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function getAccessTokenFromResponse()
    {
        return $this->getAccessToken('authorization_code', [
            'code' => $_GET[ 'code' ],
        ]);
    }
}
