<?php

namespace HMRC\Test\Response;

use GuzzleHttp\Psr7\Response;
use HMRC\Response\Response as HMRCResponse;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /** @test */
    public function it_returns_success_when_response_is_success()
    {
        $body = [
            'message' => 'example body',
        ];
        $bodyString = json_encode($body);

        $guzzleResponse = new Response(200, [], $bodyString);
        $response = new HMRCResponse($guzzleResponse);

        $this->assertTrue($response->isSuccess());
        $this->assertEquals($bodyString, $response->getBody());
        $this->assertEquals($body, $response->getArray());
    }

    /** @test */
    public function it_returns_false_when_response_is_failure()
    {
        $guzzleResponse = new Response(500, [], '');
        $response = new HMRCResponse($guzzleResponse);

        $this->assertFalse($response->isSuccess());
    }
}
