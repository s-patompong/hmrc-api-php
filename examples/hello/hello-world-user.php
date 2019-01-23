<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

if (!isset($_GET[ 'client_id' ]) || !isset($_GET[ 'client_secret' ])) {
    die ("Error: Please fill both client id and client secret before test again.");
}

$baseURL = baseURL();

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId' => $_GET[ 'client_id' ],    // The client ID assigned to you by the provider
    'clientSecret' => $_GET[ 'client_secret' ],   // The client password assigned to you by the provider
    'redirectUri' => "{$baseURL}/examples/oauth2/callback.php",
    'urlAuthorize' => 'https://test-api.service.hmrc.gov.uk/oauth/authorize',
    'urlAccessToken' => 'https://test-api.service.hmrc.gov.uk/oauth/token',
    'urlResourceOwnerDetails' => 'https://test-api.service.hmrc.gov.uk/oauth/resource',
]);

// Fetch the authorization URL from the provider; this returns the
// urlAuthorize option and generates and applies any necessary parameters
// (e.g. state).
$authorizationUrl = $provider->getAuthorizationUrl([
    'scope' => [ 'hello' ],
]);

// Get the state generated for you and store it to the session.
$_SESSION[ 'oauth2state' ] = $provider->getState();

// Redirect the user to the authorization URL.
header('Location: ' . $authorizationUrl);

exit;
