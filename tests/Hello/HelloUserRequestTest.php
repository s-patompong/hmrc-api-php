<?php

namespace HMRC\Test\Hello;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Hello\HelloUserRequest;
use HMRC\Oauth2\AccessToken as HMRCAccessToken;
use HMRC\Request\RequestMethod;
use HMRC\Test\Request\RequestTest;
use League\OAuth2\Client\Token\AccessToken;

class HelloUserRequestTest extends RequestTest
{
    /**
     * @test
     *
     * @expectedException \HMRC\Exceptions\MissingAccessTokenException
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\MissingAccessTokenException
     */
    public function it_throws_exception_when_has_no_access_token()
    {
        $request = new HelloUserRequest();
        $request->fire();
    }

    /**
     * @test
     *
     * @throws \HMRC\Exceptions\InvalidVariableTypeException
     * @throws \GuzzleHttp\Exception\GuzzleException
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
        (new HelloUserRequest())
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
        return '/hello/user';
    }

    protected function getCorrectMethod()
    {
        return RequestMethod::GET;
    }
}
