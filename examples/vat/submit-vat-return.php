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

$request = new \HMRC\VAT\SubmitVATReturnRequest($_GET['vrn']);
$request->setPeriodKey($_GET['period_key']);
$request->setVatDueSales($_GET['vat_due_sale']);
$request->setVatDueAcquisitions($_GET['vat_due_acquisitions']);
$request->setTotalVatDue($_GET['total_vat_due']);
$request->setVatReclaimedCurrPeriod($_GET['vat_reclaimed_curr_period']);
$request->setNetVatDue($_GET['net_vat_due']);
$request->setTotalValueSalesExVAT($_GET['total_value_sales_ex_vat']);
$request->setTotalValuePurchasesExVAT($_GET['total_value_purchases_ex_vat']);
$request->setTotalValueGoodsSuppliedExVAT($_GET['total_value_goods_supplied_ex_vat']);
$request->setTotalAcquisitionsExVAT($_GET['total_acquisitions_ex_vat']);
$request->setFinalised($finalised);
$response = $request->fire();
$response->echoBodyWithJsonHeader();
