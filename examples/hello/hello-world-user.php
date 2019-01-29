<?php

use HMRC\Hello\UserHelloWorldRequest;

session_start();

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

$request = new UserHelloWorldRequest();
$response = $request->fire();
$response->echoBodyWithJsonHeader();

