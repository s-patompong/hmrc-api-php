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

    $redirectURI = "{$baseURL}/examples/oauth2/callback.php";
    $callerURL = "/examples/hello/hello-world-user.php";

    try {
        $provider = new Provider(Provider::ENV_SANDBOX, $_GET[ 'client_id' ], $_GET[ 'client_secret' ], $redirectURI, $callerURL);
        $provider->redirectToAuthorizationURL([ 'hello' ]);
    } catch (Exception $e) {
        exit($e->getMessage());
    }

} else {
    // session_destroy();die;

    /** @var \League\OAuth2\Client\Token\AccessToken $accessToken */
    $accessToken = AccessToken::get();

    // Get new access token if it's expired
    if (AccessToken::hasExpired()) {
        try {
            $provider = Provider::newFromSession();
            $newToken = $provider->refreshToken();
            AccessToken::set($newToken);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    $request = new UserHelloWorldRequest($accessToken->getToken());
    try {
        $response = $request->fire();
        echo $response->getBody();
    } catch (\Exception $e) {
        exit($e->getMessage());
    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        exit($e->getMessage());
    }
}

