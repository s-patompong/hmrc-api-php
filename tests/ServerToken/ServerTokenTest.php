<?php

namespace HMRC\Test\ServerToken;

use HMRC\ServerToken\ServerToken;
use PHPUnit\Framework\TestCase;

class ServerTokenTest extends TestCase
{
    /** @test */
    public function it_can_set_server_token()
    {
        $serverToken = uniqid();

        ServerToken::getInstance()->set($serverToken);

        $this->assertEquals($serverToken, ServerToken::getInstance()->get());
    }
}
