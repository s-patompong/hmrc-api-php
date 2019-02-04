<?php

use HMRC\Hello\HelloUserRequest;

session_start();

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../helpers.php';

$request = new HelloUserRequest();
$response = $request->fire();
$response->echoBodyWithJsonHeader();
