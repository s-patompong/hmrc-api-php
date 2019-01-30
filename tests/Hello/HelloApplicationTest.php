<?php


namespace HMRC\Test\Hello;


use HMRC\Hello\HelloApplicationRequest;
use PHPUnit\Framework\TestCase;

class HelloApplicationTest extends TestCase
{
    /**
     * @expectedException HMRC\Exceptions\EmptyServerTokenException
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\EmptyServerTokenException
     */
    public function testItShouldThrowExceptionWhenServerTokenIsEmpty()
    {
        $request = new HelloApplicationRequest;
        $request->fire();
    }
}
