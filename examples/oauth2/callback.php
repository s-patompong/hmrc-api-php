<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

try {
    \HMRC\Oauth2\Provider::saveAccessTokenAndRedirectBackToCaller();
} catch (\HMRC\Exceptions\InvalidEnvironmentException $e) {
    exit($e->getMessage());
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    exit($e->getMessage());
}

