<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

if(
    !isset($_GET['vrn']) ||
    !isset($_GET['period_key']) ||
    !isset($_GET['vat_due_sale']) ||
    !isset($_GET['vat_due_acquisitions']) ||
    !isset($_GET['total_vat_due']) ||
    !isset($_GET['vat_reclaimed_curr_period']) ||
    !isset($_GET['net_vat_due']) ||
    !isset($_GET['total_value_sales_ex_vat']) ||
    !isset($_GET['total_value_purchases_ex_vat']) ||
    !isset($_GET['total_value_goods_supplied_ex_vat']) ||
    !isset($_GET['total_acquisitions_ex_vat'])
) {
    die("ERROR: Please fill vrn, period_key, vat_due_sale, vat_due_acquisitions, total_vat_due, vat_reclaimed_curr_period, net_vat_due, total_value_sales_ex_vat, total_value_purchases_ex_vat, total_value_goods_supplied_ex_vat, total_acquisitions_ex_vat and submit the form again");
}

$finalised = $_GET['finalised'] == '1' ? true : false;

$postBody = new \HMRC\VAT\SubmitVATReturnPostBody;
$postBody->setPeriodKey($_GET['period_key']);
$postBody->setVatDueSales($_GET['vat_due_sale']);
$postBody->setVatDueAcquisitions($_GET['vat_due_acquisitions']);
$postBody->setTotalVatDue($_GET['total_vat_due']);
$postBody->setVatReclaimedCurrPeriod($_GET['vat_reclaimed_curr_period']);
$postBody->setNetVatDue($_GET['net_vat_due']);
$postBody->setTotalValueSalesExVAT($_GET['total_value_sales_ex_vat']);
$postBody->setTotalValuePurchasesExVAT($_GET['total_value_purchases_ex_vat']);
$postBody->setTotalValueGoodsSuppliedExVAT($_GET['total_value_goods_supplied_ex_vat']);
$postBody->setTotalAcquisitionsExVAT($_GET['total_acquisitions_ex_vat']);
$postBody->setFinalised($finalised);

$request = new \HMRC\VAT\SubmitVATReturnRequest($_GET['vrn'], $postBody);
if(isset($_GET['gov_test_scenario'])) {
    $request->setGovTestScenario($_GET['gov_test_scenario']);
}
$response = $request->fire();
$response->echoBodyWithJsonHeader();
