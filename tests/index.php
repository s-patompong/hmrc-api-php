<?php

require_once __DIR__ . "/../vendor/autoload.php";

// $provider = new \League\OAuth2\Client\Provider\GenericProvider([
//     'clientId'                => '58Dvv2CAtfe8ZXq0nfCR5qPe7bUa',    // The client ID assigned to you by the provider
//     'clientSecret'            => '0833135d-b932-4557-bbdd-7dd8732ea009',   // The client password assigned to you by the provider
//     'redirectUri'             => 'http://hmrc-api-php.test/tests/callback.php',
//     'urlAuthorize'            => 'https://test-api.service.hmrc.gov.uk/oauth/authorize',
//     'urlAccessToken'          => 'https://test-api.service.hmrc.gov.uk/oauth/token',
//     'urlResourceOwnerDetails' => 'https://test-api.service.hmrc.gov.uk/oauth/resource'
// ]);
//
// $authorizationUrl = $provider->getAuthorizationUrl();
//
// var_dump($authorizationUrl);

$request = new \HMRC\Hello\HelloWorldRequest();
try {
    $response = $request->fire();
    echo $response->getBody();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    var_dump($e->getMessage());
}
