<?php

namespace HMRC\Test\Hello;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Hello\HelloWorldRequest;
use HMRC\Request\RequestMethod;
use HMRC\Test\Request\RequestTest;

class HelloWorldRequestTest extends RequestTest
{
    /**
     * @test
     */
    public function it_calls_correct_endpoint()
    {
        // Setup mocked client
        $container = [];
        $stack = HandlerStack::create(new MockHandler([
            new Response(200),
        ]));
        $stack->push(Middleware::history($container));
        $mockedClient = new Client(['handler' => $stack]);

        // Call the API
        (new HelloWorldRequest())
            ->setClient($mockedClient)
            ->fire();

        // Asserts
        $this->assertCount(1, $container);

        /** @var Request $guzzleRequest */
        $guzzleRequest = $container[0]['request'];
        $this->assertUri($guzzleRequest);
        $this->assertAcceptHeader($guzzleRequest);
        $this->assertMethod($guzzleRequest);
    }

    protected function getCorrectPath()
    {
        return '/hello/world';
    }

    protected function getCorrectMethod()
    {
        return RequestMethod::GET;
    }
}
