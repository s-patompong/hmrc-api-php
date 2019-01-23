<?php

require_once __DIR__ . "/../../vendor/autoload.php";

if(!isset($_GET['server_token'])) {
    die ("Error: Please fill server token before test again.");
}

$request = new \HMRC\Hello\ApplicationHelloWorldRequest($_GET['server_token']);
try {
    $response = $request->fire();
    echo $response->getBody();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    echo $e->getMessage();
}
