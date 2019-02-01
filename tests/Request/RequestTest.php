<?php


namespace HMRC\Test\Request;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use HMRC\ServerToken\ServerToken;
use HMRC\Test\Hello\HelloApplicationRequestTest;
use PHPUnit\Framework\TestCase;

abstract class RequestTest extends TestCase
{
    /** @var array  */
    protected $container = [];

    /** @var Client */
    protected $mockedClient;

    /**
     * Get client with mocked response
     * Reference: http://docs.guzzlephp.org/en/stable/testing.html
     *
     */
    protected function createMockClient()
    {
        $mock = new MockHandler([
            new Response(200),
        ]);

        $container = [];
        $history = Middleware::history($container);

        $stack = HandlerStack::create($mock);
        $stack->push($history);

        $this->mockedClient = new Client([ 'handler' => $stack ]);
        $this->container = $container;
    }

    protected function setServerToken($serverToken)
    {
        ServerToken::getInstance()->set($serverToken);
    }

    protected function assertUri(Uri $uri)
    {
        $this->assertHttps($uri->getScheme());
        $this->assertSandboxHost($uri->getHost());
        $this->assertPath($this->getCorrectPath(), $uri->getPath());
    }

    protected function assertSandboxHost(string $host)
    {
        $this->assertEquals('test-api.service.hmrc.gov.uk', $host);
    }

    protected function assertHttps(string $scheme)
    {
        $this->assertEquals('https', $scheme);
    }

    protected function assertPath(string $correctPath, string $path)
    {
        $this->assertEquals($correctPath, $path);
    }

    abstract protected function getCorrectPath();

    /**
     * @param Request $guzzleRequest
     * @param string $token
     */
    protected function assertAuthorizationHeader(Request $guzzleRequest, string $token)
    {
        $authorizationHeader = $guzzleRequest->getHeader('Authorization');
        $this->assertCount(1, $authorizationHeader);
        $this->assertEquals("Bearer $token", $authorizationHeader[ 0 ]);
    }
}
