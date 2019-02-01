<?php


namespace HMRC\Test\VAT;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Oauth2\AccessToken as HMRCAccessToken;
use HMRC\Test\Request\RequestTest;
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
        $this->periodKey = "A001";
    }

    /**
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \HMRC\Exceptions\MissingAccessTokenException
     * @throws \ReflectionException
     */
    public function testItThrowErrorWhenGiveWrongGovTestScenario()
    {
        $request = new ViewVATReturnRequest($this->vrn, $this->periodKey);
        $request->setGovTestScenario('WRONG')->fire();
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
    }

    protected function getCorrectPath()
    {
        return "/organisations/vat/{$this->vrn}/returns/{$this->periodKey}";
    }
}
