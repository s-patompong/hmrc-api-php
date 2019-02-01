<?php


namespace HMRC\Test\VAT;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Oauth2\AccessToken as HMRCAccessToken;
use HMRC\Request\Request as HMRCRequest;
use HMRC\Test\Request\RequestTest;
use HMRC\VAT\SubmitVATReturnGovTestScenario;
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
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function testItThrowErrorWhenGiveWrongGovTestScenario()
    {
        $request = new SubmitVATReturnRequest($this->vrn);
        $request->setGovTestScenario('WRONG');
    }

    /**
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function testItDoesNotThrowErrorWhenGiveCorrectGovTestScenario()
    {
        $request = new SubmitVATReturnRequest($this->vrn);
        $request->setGovTestScenario(SubmitVATReturnGovTestScenario::INVALID_PERIODKEY);

        $this->addToAssertionCount(1);
    }

    /**
     * @expectedException \HMRC\Exceptions\MissingFieldsException
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\MissingAccessTokenException
     * @throws \HMRC\Exceptions\MissingFieldsException
     */
    public function testItThrowExceptionWhenMissingFields()
    {
        $request = new SubmitVATReturnRequest($this->vrn);
        $request->fire();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\InvalidVariableTypeException
     */
    public function testItCallsCorrectEndpoint()
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
        $periodKey = "A001";
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

        // Call the API
        (new SubmitVATReturnRequest($this->vrn))
            ->setPeriodKey($periodKey)
            ->setVatDueSales($vatDueSales)
            ->setVatDueAcquisitions($vatDueAcquisitions)
            ->setTotalVatDue($totalVatDue)
            ->setVatReclaimedCurrPeriod($vatReclaimedCurrPeriod)
            ->setNetVatDue($netVatDue)
            ->setTotalValueSalesExVAT($totalValueSalesExVAT)
            ->setTotalValuePurchasesExVAT($totalValuePurchasesExVAT)
            ->setTotalValueGoodsSuppliedExVAT($totalValueGoodsSuppliedExVAT)
            ->setTotalAcquisitionsExVAT($totalAcquisitionsExVAT)
            ->setFinalised($finalised)
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
        return HMRCRequest::METHOD_POST;
    }
}
