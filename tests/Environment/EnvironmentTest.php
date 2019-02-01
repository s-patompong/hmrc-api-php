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
        $this->assertEquals(true, $this->environment->isSandbox());
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
        $this->assertEquals(true, Environment::getInstance()->isSandbox());

        Environment::getInstance()->setToLive();
        $this->assertEquals(true, Environment::getInstance()->isLive());

        Environment::reset();
        $this->assertEquals(true, Environment::getInstance()->isSandbox());
    }

    protected function tearDown()
    {
        Environment::reset();
    }
}
