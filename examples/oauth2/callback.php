<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

$baseURL = baseURL();

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId' => $_SESSION[ 'client_id' ],    // The client ID assigned to you by the provider
    'clientSecret' => $_SESSION[ 'client_secret' ],   // The client password assigned to you by the provider
    'redirectUri' => $_SESSION[ 'redirect_uri' ],
    'urlAuthorize' => 'https://test-api.service.hmrc.gov.uk/oauth/authorize',
    'urlAccessToken' => 'https://test-api.service.hmrc.gov.uk/oauth/token',
    'urlResourceOwnerDetails' => 'https://test-api.service.hmrc.gov.uk/oauth/resource',
]);

try {

    $accessToken = $provider->getAccessToken('authorization_code', [
        'code' => $_GET[ 'code' ],
    ]);

    $_SESSION[ 'access_token' ] = $accessToken;

    header('Location: ' . $_SESSION[ 'caller' ]);
    exit;

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    exit($e->getMessage());
}
