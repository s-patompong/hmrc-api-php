<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

if(!isset($_GET['vrn']) || !isset($_GET['from']) || !isset($_GET['to'])) {
    die("ERROR: Please fill VRN, From, To and submit the form again");
}

$status = isset($_GET['status']) ? $_GET['status'] : null;
$govTestScenario = isset($_GET['gov_test_scenario']) ? $_GET['gov_test_scenario'] : null;

$request = new \HMRC\VAT\VATObligationsRequest("666969555", "2018-01-01", "2019-01-01", $status, $govTestScenario);
$response = $request->fire();
