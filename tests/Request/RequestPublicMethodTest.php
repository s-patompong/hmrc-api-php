<?php

namespace HMRC\Test\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use HMRC\Hello\HelloWorldRequest;
use PHPUnit\Framework\TestCase;

class RequestPublicMethodTest extends TestCase
{
    /** @test */
    public function it_has_correct_accept_header_when_ser_version_and_content_type()
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
            ->setServiceVersion('2.0')
            ->setContentType('xml')
            ->fire();

        // Asserts
        $this->assertCount(1, $container);

        /** @var Request $guzzleRequest */
        $guzzleRequest = $container[0]['request'];
        $acceptHeader = $guzzleRequest->getHeader('Accept');
        $this->assertCount(1, $acceptHeader);
        $this->assertEquals('application/vnd.hmrc.2.0+xml', $acceptHeader[0]);
    }
}
