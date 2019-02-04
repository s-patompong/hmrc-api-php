<?php

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../helpers.php';

session_start();

if (
    !isset($_GET['vrn']) ||
    !isset($_GET['period_key'])
) {
    die('ERROR: Please fill vrn, period_key and submit the form again');
}

$request = new \HMRC\VAT\ViewVATReturnRequest($_GET['vrn'], $_GET['period_key']);
if (isset($_GET['gov_test_scenario'])) {
    $request->setGovTestScenario($_GET['gov_test_scenario']);
}
$response = $request->fire();
$response->echoBodyWithJsonHeader();
