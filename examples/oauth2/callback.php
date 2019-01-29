<?php

use HMRC\Oauth2\Provider;

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

$provider = new Provider(
    $_SESSION[ 'client_id' ],
    $_SESSION[ 'client_secret' ],
    $_SESSION[ 'callback_uri' ]
);

// Try to get an access token using the authorization code grant.
$accessToken = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

\HMRC\Oauth2\AccessToken::set($accessToken);

header("Location: /examples/index.php");
exit;

