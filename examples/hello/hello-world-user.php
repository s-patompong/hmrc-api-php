<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

$baseURL = baseURL();

if (!isset($_SESSION[ 'access_token' ])) {

    if (!isset($_GET[ 'client_id' ]) || !isset($_GET[ 'client_secret' ])) {
        die ("Error: Please fill both client id and client secret before test again.");
    }

    // $_SESSION[ 'provider' ] = $_GET[ 'client_id' ];
    // $_SESSION[ 'client_secret' ] = $_GET[ 'client_secret' ];

    $provider = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId' => $_GET[ 'client_id' ],    // The client ID assigned to you by the provider
        'clientSecret' => $_GET[ 'client_secret' ],   // The client password assigned to you by the provider
        'redirectUri' => "{$baseURL}/examples/oauth2/callback.php",
        'urlAuthorize' => 'https://test-api.service.hmrc.gov.uk/oauth/authorize',
        'urlAccessToken' => 'https://test-api.service.hmrc.gov.uk/oauth/token',
        'urlResourceOwnerDetails' => 'https://test-api.service.hmrc.gov.uk/oauth/resource',
    ]);

    // $_SESSION[ 'provider' ] = $provider;

    $authorizationUrl = $provider->getAuthorizationUrl([
        'scope' => [ 'hello' ],
    ]);

    $_SESSION[ 'client_id' ] = $_GET[ 'client_id' ];
    $_SESSION[ 'client_secret' ] = $_GET[ 'client_secret' ];
    $_SESSION[ 'redirect_uri' ] = "{$baseURL}/examples/oauth2/callback.php";
    $_SESSION[ 'oauth2_state' ] = $provider->getState();
    $_SESSION[ 'caller' ] = "/examples/hello/hello-world-user.php";

    header('Location: ' . $authorizationUrl);

    exit;

} else {
    /** @var \League\OAuth2\Client\Token\AccessToken $accessToken */
    $accessToken = $_SESSION[ 'access_token' ];

    // Get new access token if it's expired
    if ($accessToken->hasExpired()) {
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => $_SESSION[ 'client_id' ],    // The client ID assigned to you by the provider
            'clientSecret' => $_SESSION[ 'client_secret' ],   // The client password assigned to you by the provider
            'redirectUri' => "{$baseURL}/examples/oauth2/callback.php",
            'urlAuthorize' => 'https://test-api.service.hmrc.gov.uk/oauth/authorize',
            'urlAccessToken' => 'https://test-api.service.hmrc.gov.uk/oauth/token',
            'urlResourceOwnerDetails' => 'https://test-api.service.hmrc.gov.uk/oauth/resource',
        ]);

        try {
            $accessToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $accessToken->getRefreshToken(),
            ]);

            $_SESSION[ 'access_token' ] = $accessToken;
        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            die($e->getMessage());
        }

    }

    $request = new \HMRC\Hello\UserHelloWorldRequest($accessToken->getToken());
    try {
        $response = $request->fire();
        echo $response->getBody();
    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        die($e->getMessage());
    }
}

