<?php

require_once __DIR__.'/../../vendor/autoload.php';

if (!isset($_GET['server_token'])) {
    exit('Error: Please fill server token before test again.');
}

session_start();

\HMRC\ServerToken\ServerToken::getInstance()->set($_GET['server_token']);

$request = new \HMRC\Hello\HelloApplicationRequest();
$response = $request->fire();
$response->echoBodyWithJsonHeader();
