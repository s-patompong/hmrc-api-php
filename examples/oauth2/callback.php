<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

try {
    $provider = \HMRC\Oauth2\Provider::newFromSession();
} catch (\HMRC\Exceptions\InvalidEnvironmentException $e) {
    exit($e->getMessage());
}

try {
    $accessToken = $provider->getAccessToken('authorization_code', [
        'code' => $_GET[ 'code' ],
    ]);
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    exit($e->getMessage());
}

\HMRC\Oauth2\AccessToken::set($accessToken);
$provider->redirectToCaller();

