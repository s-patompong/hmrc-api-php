<?php

require_once __DIR__ . "/../../vendor/autoload.php";

$request = new \HMRC\Hello\HelloWorldRequest();
try {
    $response = $request->fire();
    echo $response->getBody();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    var_dump($e->getMessage());
}
