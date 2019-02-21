<?php

namespace HMRC\Test\VAT;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Exceptions\InvalidPostBodyException;
use HMRC\Exceptions\InvalidVariableValueException;
use HMRC\Oauth2\AccessToken as HMRCAccessToken;
use HMRC\Request\RequestMethod;
use HMRC\Test\Request\RequestTest;
use HMRC\VAT\SubmitVATReturnGovTestScenario;
use HMRC\VAT\SubmitVATReturnPostBody;
use HMRC\VAT\SubmitVATReturnRequest;
use League\OAuth2\Client\Token\AccessToken;

class SubmitVATReturnRequestTest extends RequestTest
{
    private $vrn;

    public function __construct()
    {
        parent::__construct();

        $this->vrn = uniqid();
    }

    /**
     * @test
     */
    public function it_throws_exception_when_given_wrong_government_test_scenario()
    {
        $this->expectException(InvalidVariableValueException::class);

        $request = new SubmitVATReturnRequest($this->vrn, new SubmitVATReturnPostBody());
        $request->setGovTestScenario('WRONG');
    }

    /**
     * @test
     */
    public function it_doesnt_throws_exception_when_given_correct_government_test_scenario()
    {
        $request = new SubmitVATReturnRequest($this->vrn, new SubmitVATReturnPostBody());
        $request->setGovTestScenario(SubmitVATReturnGovTestScenario::INVALID_PERIODKEY);

        $this->addToAssertionCount(1);
    }

    /**
     * @test
     */
    public function it_throws_exception_when_has_no_post_body()
    {
        $this->expectException(InvalidPostBodyException::class);

        $request = new SubmitVATReturnRequest($this->vrn, new SubmitVATReturnPostBody());
        $request->fire();
    }

    /**
     * @test
     */
    public function it_calls_correct_endpoint()
    {
        // Setup access token
        $accessToken = uniqid();
        HMRCAccessToken::set(new AccessToken([
            'access_token' => $accessToken,
        ]));

        // Setup mocked client
        $container = [];
        $stack = HandlerStack::create(new MockHandler([
            new Response(200),
        ]));
        $stack->push(Middleware::history($container));
        $mockedClient = new Client(['handler' => $stack]);

        // Setup variable
        $periodKey = 'A001';
        $vatDueSales = 100;
        $vatDueAcquisitions = 101;
        $totalVatDue = 102;
        $vatReclaimedCurrPeriod = 103;
        $netVatDue = 104;
        $totalValueSalesExVAT = 105;
        $totalValuePurchasesExVAT = 106;
        $totalValueGoodsSuppliedExVAT = 107;
        $totalAcquisitionsExVAT = 108;
        $finalised = true;

        $postBody = new SubmitVATReturnPostBody();
        $postBody->setPeriodKey($periodKey)
            ->setVatDueSales($vatDueSales)
            ->setVatDueAcquisitions($vatDueAcquisitions)
            ->setTotalVatDue($totalVatDue)
            ->setVatReclaimedCurrPeriod($vatReclaimedCurrPeriod)
            ->setNetVatDue($netVatDue)
            ->setTotalValueSalesExVAT($totalValueSalesExVAT)
            ->setTotalValuePurchasesExVAT($totalValuePurchasesExVAT)
            ->setTotalValueGoodsSuppliedExVAT($totalValueGoodsSuppliedExVAT)
            ->setTotalAcquisitionsExVAT($totalAcquisitionsExVAT)
            ->setFinalised($finalised);

        // Call the API
        (new SubmitVATReturnRequest($this->vrn, $postBody))
            ->setClient($mockedClient)
            ->fire();

        // Asserts
        $this->assertCount(1, $container);

        /** @var Request $guzzleRequest */
        $guzzleRequest = $container[0]['request'];
        $this->assertUri($guzzleRequest);
        $this->assertAuthorizationHeader($guzzleRequest, $accessToken);
        $this->assertAcceptHeader($guzzleRequest);
        $this->assertMethod($guzzleRequest);

        // Assert post body
        $postBody = json_decode($guzzleRequest->getBody()->getContents());
        $this->assertEquals($periodKey, $postBody->periodKey);
        $this->assertEquals($vatDueSales, $postBody->vatDueSales);
        $this->assertEquals($vatDueAcquisitions, $postBody->vatDueAcquisitions);
        $this->assertEquals($totalVatDue, $postBody->totalVatDue);
        $this->assertEquals($vatReclaimedCurrPeriod, $postBody->vatReclaimedCurrPeriod);
        $this->assertEquals($netVatDue, $postBody->netVatDue);
        $this->assertEquals($totalValueSalesExVAT, $postBody->totalValueSalesExVAT);
        $this->assertEquals($totalValuePurchasesExVAT, $postBody->totalValuePurchasesExVAT);
        $this->assertEquals($totalValueGoodsSuppliedExVAT, $postBody->totalValueGoodsSuppliedExVAT);
        $this->assertEquals($totalAcquisitionsExVAT, $postBody->totalAcquisitionsExVAT);
        $this->assertEquals($finalised, $postBody->finalised);
    }

    protected function getCorrectPath()
    {
        return "/organisations/vat/{$this->vrn}/returns";
    }

    protected function getCorrectMethod()
    {
        return RequestMethod::POST;
    }
}
