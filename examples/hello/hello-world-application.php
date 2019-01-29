<?php

require_once __DIR__ . "/../../vendor/autoload.php";

if(!isset($_GET['server_token'])) {
    die ("Error: Please fill server token before test again.");
}

session_start();

$request = new \HMRC\Hello\ApplicationHelloWorldRequest($_GET['server_token']);
$response = $request->fire();
$response->echoBodyWithJsonHeader();
