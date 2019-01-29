<?php

require_once __DIR__ . "/../vendor/autoload.php";

use HMRC\Oauth2\AccessToken;

session_start();

$accessToken = AccessToken::get();

$clientId = 'clientid';
$clientSecret = 'clientsecret';
$serverToken = 'servertoken';

$vrn = '666383495';
$vatObligationFrom = '2018-01-01';
$vatObligationTo = '2019-01-01';
$vatObligationStatus = '';
$vatObligationGovTestScenario = '';

$submitVatReturnVatDueSales = 105.50;
$submitVatReturnVatDueAcquisitions = -100.45;
$submitVatReturnTotalVatDue = 5.05;
$submitVatReturnVatReclaimedCurrPeriod = 105.15;
$submitVatReturnNetVatDue = 100.10;
$submitVatReturnTotalValueSalesExVAT = 300;
$submitVatReturnTotalValuePurchasesExVAT = 300;
$submitVatReturnTotalValueGoodsSuppliedExVAT = 3000;
$submitVatReturnTotalAcquisitionsExVAT = 3000;

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>HMRC API Examples</title>
    <style>
        body {
            margin-top: 10px;
        }

        td {
            vertical-align: middle !important;
        }

        td.test-btn {
            width: 70px !important;
            text-align: center !important;
        }
    </style>
</head>
<body class="container">
<h3>HMRC API Examples</h3>
<hr>
<div>
    <div class="row">
        <div class="col-sm">
            <input type="text" class="form-control" name="client_id" placeholder="Client ID"
                   value="<?php echo $clientId; ?>">
        </div>
        <div class="col-sm">
            <input type="text" class="form-control" name="client_secret" placeholder="Client Secret"
                   value="<?php echo $clientSecret; ?>">
        </div>
        <div class="col-sm">
            <input type="text" class="form-control" name="server_token" placeholder="Server Token"
                   value="<?php echo $serverToken; ?>">
        </div>
    </div>
</div>

<div style="margin-top: 10px">
    <input type="hidden" name="access_token" value="<?php echo AccessToken::get(); ?>">
    <div id="access-token-container"></div>
    <a href="javascript:void(0)" onclick="authorize()"
       class="btn btn-sm btn-warning" style="margin-top: 10px" id="create-access-token-btn">Create access token</a>
    <a href="/examples/oauth2/destroy-session.php" class="btn btn-sm btn-danger" style="margin-top: 10px"
       id="destroy-session-btn">Destroy session</a>
</div>
<hr>

<div id="features">
    <div>
        <h3>Hello</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm">
                <tr>
                    <td>Hello world</td>
                    <td class="test-btn">
                        <a href='/examples/hello/hello-world.php'>
                            <button class="btn btn-sm btn-primary">Test</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Hello world application <span class="badge badge-danger">Server Token</span></td>
                    <td class="test-btn">
                        <a href="javascript:void(0)" onclick="helloWorldApplication()">
                            <button class="btn btn-sm btn-primary">Test</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Hello world user
                    </td>
                    <td class="test-btn">
                        <a href='/examples/hello/hello-world-user.php'>
                            <button class="btn btn-sm btn-primary">Test</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <hr>

    <div>
        <h3>VAT</h3>
        <div class="form-group">
            <input type="text" name="vrn" class="form-control" placeholder="VAT registration number"
                   value="<?php echo $vrn; ?>">
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm">
                <tr>
                    <td>
                        <p>Retrieve VAT obligations</p>
                        <div class="form-group">
                            <input type="text" class="form-control" name="vat_obligations_from"
                                   placeholder="From: yyyy-mm-dd (2019-01-25)"
                                   value="<?php echo $vatObligationFrom; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="vat_obligations_to"
                                   placeholder="To: yyyy-mm-dd (2019-01-30)" value="<?php echo $vatObligationTo; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="vat_obligations_status"
                                   placeholder="Status" value="<?php echo $vatObligationStatus; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="vat_obligations_gov_test_scenario"
                                   placeholder="Gov test scenario" value="<?php echo $vatObligationGovTestScenario; ?>">
                        </div>
                    </td>
                    <td class="test-btn">
                        <a href="javascript:void(0)" onclick="retrieveVATObligations()">
                            <button class="btn btn-sm btn-primary">Test</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Submit VAT return for period</p>
                        <div class="form-group">
                            <input type="text" class="form-control" name="submit_vat_return_period_key"
                                   placeholder="Period Key">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="submit_vat_return_vat_due_sale"
                                   placeholder="VAT Due Sales" value="<?php echo $submitVatReturnVatDueSales; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="submit_vat_return_vat_due_acquisitions"
                                   placeholder="VAT Due Acquisitions" value="<?php echo $submitVatReturnVatDueAcquisitions; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="submit_vat_return_total_vat_due"
                                   placeholder="Total VAT Due" value="<?php echo $submitVatReturnTotalVatDue; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="submit_vat_return_vat_reclaimed_curr_period"
                                   placeholder="VAT Reclaimed CURR Period" value="<?php echo $submitVatReturnVatReclaimedCurrPeriod; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="submit_vat_return_net_vat_due"
                                   placeholder="NET VAT Due" value="<?php echo $submitVatReturnNetVatDue; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="submit_vat_return_total_value_sales_ex_vat"
                                   placeholder="Total Value Sales EX VAT" value="<?php echo $submitVatReturnTotalValueSalesExVAT; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control"
                                   name="submit_vat_return_total_value_purchases_ex_vat"
                                   placeholder="Total Value Purchases EX VAT" value="<?php echo $submitVatReturnTotalValuePurchasesExVAT; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control"
                                   name="submit_vat_return_total_value_goods_supplied_ex_vat"
                                   placeholder="Total Value Goods Supplied EX VAT" value="<?php echo $submitVatReturnTotalValueGoodsSuppliedExVAT; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="submit_vat_return_total_acquisitions_ex_vat"
                                   placeholder="Total Acquisitions EX VAT" value="<?php echo $submitVatReturnTotalAcquisitionsExVAT; ?>">
                        </div>
                        <div class="form-group">
                            <select name="submit_vat_return_finalised" class="form-control">
                                <option value="0">No</option>
                                <option value="1" selected>Yes</option>
                            </select>
                        </div>
                    </td>
                    <td class="test-btn">
                        <a href="javascript:void(0)" onclick="submitVATReturn()">
                            <button class="btn btn-sm btn-primary">Test</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>
    $(function () {
        const accessToken = $("input[name='access_token']").val();
        const features = $("#features");
        let accessTokenContainer = $("#access-token-container");
        let createAccessTokenBtn = $("#create-access-token-btn");
        let destroySessionBtn = $("#destroy-session-btn");

        if (accessToken === "") { // Doesn't have access token
            accessTokenContainer.text("Access Token: Doesn't exists.");
            destroySessionBtn.hide();
            features.hide();
        } else {
            createAccessTokenBtn.hide();
            accessTokenContainer.text("Access Token: " + accessToken);
        }
    });

    function authorize() {
        const clientId = $("input[name='client_id']").val();
        const clientSecret = $("input[name='client_secret']").val();

        let query = [];
        if (clientId !== "") query.push(`client_id=${clientId}`);
        if (clientSecret !== "") query.push(`client_secret=${clientSecret}`);
        const queryString = query.join('&');
        if (query.length) {
            location.href = '/examples/oauth2/create-access-token.php' + '?' + queryString;
        } else {
            location.href = '/examples/oauth2/create-access-token.php';
        }
    }

    function helloWorldApplication() {
        const serverToken = $("input[name='server_token']").val();

        let query = [];
        if (serverToken !== "") query.push(`server_token=${serverToken}`);
        const queryString = query.join('&');
        if (query.length) {
            location.href = '/examples/hello/hello-world-application.php' + '?' + queryString;
        } else {
            location.href = '/examples/hello/hello-world-application.php';
        }
    }

    function retrieveVATObligations() {
        const vrn = $("input[name='vrn']").val();
        const from = $("input[name='vat_obligations_from']").val();
        const to = $("input[name='vat_obligations_to']").val();
        const status = $("input[name='vat_obligations_status']").val();
        const govTestScenario = $("input[name='vat_obligations_gov_test_scenario']").val();

        let query = [];

        if (vrn !== "") query.push(`vrn=${vrn}`);
        if (from !== "") query.push(`from=${from}`);
        if (to !== "") query.push(`to=${to}`);
        if (status !== "") query.push(`status=${status}`);
        if (govTestScenario !== "") query.push(`gov_test_scenario=${govTestScenario}`);
        const queryString = query.join('&');
        if (query.length) {
            location.href = "/examples/vat/get-vat-obligations.php" + '?' + queryString;
        } else {
            location.href = "/examples/vat/get-vat-obligations.php";
        }
    }

    function submitVATReturn() {
        const vrn = $("input[name='vrn']").val();
        const periodKey = $("input[name='submit_vat_return_period_key']").val();
        const vatDueSale = $("input[name='submit_vat_return_vat_due_sale']").val();
        const vatDueAcquisitions = $("input[name='submit_vat_return_vat_due_acquisitions']").val();
        const totalVatDue = $("input[name='submit_vat_return_total_vat_due']").val();
        const vatReclaimedCurrPeriod = $("input[name='submit_vat_return_vat_reclaimed_curr_period']").val();
        const NetVatDue = $("input[name='submit_vat_return_net_vat_due']").val();
        const totalValueSalesEXVat = $("input[name='submit_vat_return_total_value_sales_ex_vat']").val();
        const totalValuePurchasesEXVat = $("input[name='submit_vat_return_total_value_purchases_ex_vat']").val();
        const totalValueGoodsSuppliedEXVat = $("input[name='submit_vat_return_total_value_goods_supplied_ex_vat']").val();
        const totalAcquisitionsEXVat = $("input[name='submit_vat_return_total_acquisitions_ex_vat']").val();
        const finalised = $("select[name='submit_vat_return_finalised']").val();

        let query = [];
        if (vrn !== "") query.push(`vrn=${vrn}`);
        if (periodKey !== "") query.push(`period_key=${periodKey}`);
        if (vatDueSale !== "") query.push(`vat_due_sale=${vatDueSale}`);
        if (vatDueAcquisitions !== "") query.push(`vat_due_acquisitions=${vatDueAcquisitions}`);
        if (totalVatDue !== "") query.push(`total_vat_due=${totalVatDue}`);
        if (vatReclaimedCurrPeriod !== "") query.push(`vat_reclaimed_curr_period=${vatReclaimedCurrPeriod}`);
        if (NetVatDue !== "") query.push(`net_vat_due=${NetVatDue}`);
        if (totalValueSalesEXVat !== "") query.push(`total_value_sales_ex_vat=${totalValueSalesEXVat}`);
        if (totalValuePurchasesEXVat !== "") query.push(`total_value_purchases_ex_vat=${totalValuePurchasesEXVat}`);
        if (totalValueGoodsSuppliedEXVat !== "") query.push(`total_value_goods_supplied_ex_vat=${totalValueGoodsSuppliedEXVat}`);
        if (totalAcquisitionsEXVat !== "") query.push(`total_acquisitions_ex_vat=${totalAcquisitionsEXVat}`);
        if (finalised !== "") query.push(`finalised=${finalised}`);
        const queryString = query.join('&');
        if (query.length) {
            location.href = "/examples/vat/submit-vat-return.php" + '?' + queryString;
        } else {
            location.href = "/examples/vat/submit-vat-return.php";
        }
    }
</script>
</body>
</html>

