<?php

namespace HMRC\Test\VAT;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Oauth2\AccessToken as HMRCAccessToken;
use HMRC\Request\RequestMethod;
use HMRC\Test\Request\RequestTest;
use HMRC\VAT\ViewVATReturnGovTestScenario;
use HMRC\VAT\ViewVATReturnRequest;
use League\OAuth2\Client\Token\AccessToken;

class ViewVATReturnRequestTest extends RequestTest
{
    private $vrn;

    private $periodKey;

    public function __construct()
    {
        parent::__construct();

        $this->vrn = uniqid();
        $this->periodKey = 'A001';
    }

    /**
     * @test
     *
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function it_throws_exception_when_given_wrong_government_test_scenario()
    {
        $request = new ViewVATReturnRequest($this->vrn, $this->periodKey);
        $request->setGovTestScenario('WRONG');
    }

    /**
     * @test
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function it_doesnt_throws_exception_when_given_correct_government_test_scenario()
    {
        $request = new ViewVATReturnRequest($this->vrn, $this->periodKey);
        $request->setGovTestScenario(ViewVATReturnGovTestScenario::DATE_RANGE_TOO_LARGE);

        $this->addToAssertionCount(1);
    }

    /**
     * @test
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\InvalidVariableTypeException
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

        // Call the API
        (new ViewVATReturnRequest($this->vrn, $this->periodKey))
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
    }

    protected function getCorrectPath()
    {
        return "/organisations/vat/{$this->vrn}/returns/{$this->periodKey}";
    }

    protected function getCorrectMethod()
    {
        return RequestMethod::GET;
    }
}
