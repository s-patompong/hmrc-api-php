<?php

use HMRC\Hello\UserHelloWorldRequest;
use HMRC\Oauth2\AccessToken;

session_start();

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

$request = new UserHelloWorldRequest();
$response = $request->fire();
echo $response->getBody();

