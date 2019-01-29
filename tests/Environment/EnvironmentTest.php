<?php


namespace HMRC\Test\Environment;


use HMRC\Environment\Environment;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    /** @var Environment */
    private $environment;

    protected function setUp()
    {
        $this->environment = Environment::getInstance();
    }

    public function testUsesSandboxModeByDefault()
    {
        $this->assertEquals($this->environment->isSandbox(), true);
    }

    /**
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     */
    public function testThrowExceptionWhenGivenWrongEnvironment()
    {
        $this->environment->setEnv('wrong');
    }

    /**
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     */
    public function testCanSetCorrectEnv()
    {
        $this->environment->setEnv(Environment::LIVE);

        $this->addToAssertionCount(1);
    }

    public function testItCanBeReset()
    {
        $this->assertEquals(Environment::getInstance()->isSandbox(), true);

        Environment::getInstance()->setToLive();
        $this->assertEquals(Environment::getInstance()->isLive(), true);

        Environment::reset();
        $this->assertEquals(Environment::getInstance()->isSandbox(), true);
    }

    protected function tearDown()
    {
        Environment::reset();
    }
}
