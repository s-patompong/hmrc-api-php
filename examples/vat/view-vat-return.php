<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

if(
    !isset($_GET['vrn']) ||
    !isset($_GET['period_key'])
) {
    die("ERROR: Please fill vrn, period_key and submit the form again");
}

$request = new \HMRC\VAT\ViewVATReturnRequest($_GET['vrn'], $_GET['period_key']);

refreshAccessTokenIfNeeded();

$response = $request->fire();
$response->echoBodyWithJsonHeader();
