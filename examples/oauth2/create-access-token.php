<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

use HMRC\Oauth2\Provider;
use HMRC\Scope\Scope;


if (!isset($_GET[ 'client_id' ]) || !isset($_GET[ 'client_secret' ])) {
    die ("Error: Please fill both client id and client secret before test again.");
}

session_start();

$baseURL = baseURL();
$callbackUri = "{$baseURL}/examples/oauth2/callback.php" ;

$_SESSION[ 'client_id' ] = $_GET[ 'client_id' ];
$_SESSION[ 'client_secret' ] = $_GET[ 'client_secret' ];
$_SESSION[ 'callback_uri' ] = $callbackUri;
$_SESSION[ 'caller' ] = "/examples/index.php";

$provider = new Provider(
    $_GET[ 'client_id' ],
    $_GET[ 'client_secret' ],
    $callbackUri
);
$scope = [ Scope::VAT_READ, Scope::HELLO, Scope::VAT_WRITE ];
$provider->redirectToAuthorizationURL($scope);
