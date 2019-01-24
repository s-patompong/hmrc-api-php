<?php

require_once __DIR__ . "/../../vendor/autoload.php";

$request = new \HMRC\Hello\HelloWorldRequest();
$response = $request->fire();
echo $response->getBody();
