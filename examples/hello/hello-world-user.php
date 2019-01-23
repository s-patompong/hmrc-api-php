<?php

use HMRC\Hello\UserHelloWorldRequest;
use HMRC\Oauth2\AccessToken;
use HMRC\Oauth2\Provider;

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

$baseURL = baseURL();

if (!AccessToken::exists()) {

    if (!isset($_GET[ 'client_id' ]) || !isset($_GET[ 'client_secret' ])) {
        die ("Error: Please fill both client id and client secret before test again.");
    }

    $provider = new Provider(
        Provider::ENV_SANDBOX,
        $_GET[ 'client_id' ],
        $_GET[ 'client_secret' ],
        "{$baseURL}/examples/oauth2/callback.php",
        "/examples/hello/hello-world-user.php"
    );
    $scope = [ 'hello' ];
    $provider->redirectToAuthorizationURL($scope);
} else {
    // session_destroy();die;

    $request = new UserHelloWorldRequest(AccessToken::get());
    $response = $request->fire();
    echo $response->getBody();
}

