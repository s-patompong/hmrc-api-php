<?php

namespace HMRC\Test\Environment;

use HMRC\Environment\Environment;
use HMRC\Exceptions\InvalidVariableValueException;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{
    /** @var Environment */
    private $environment;

    protected function setUp(): void
    {
        $this->environment = Environment::getInstance();
    }

    /**
     * @test
     */
    public function it_uses_sandbox_mode_by_default()
    {
        $this->assertEquals(true, $this->environment->isSandbox());
    }

    /**
     * @test
     */
    public function it_throws_exception_when_given_wrong_environment()
    {
        $this->expectException(InvalidVariableValueException::class);

        $this->environment->setEnv('wrong');
    }

    /**
     * @test
     */
    public function it_accepts_correct_environment()
    {
        $this->environment->setEnv(Environment::LIVE);

        $this->addToAssertionCount(1);
    }

    /**
     * @test
     */
    public function it_can_be_reset()
    {
        $this->assertEquals(true, Environment::getInstance()->isSandbox());

        Environment::getInstance()->setToLive();
        $this->assertEquals(true, Environment::getInstance()->isLive());

        Environment::reset();
        $this->assertEquals(true, Environment::getInstance()->isSandbox());
    }

    protected function tearDown(): void
    {
        Environment::reset();
    }
}
