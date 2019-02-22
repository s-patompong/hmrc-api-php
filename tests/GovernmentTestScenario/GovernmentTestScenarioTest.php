<?php

namespace HMRC\Test\GovernmentTestScenario;

use HMRC\Exceptions\InvalidVariableValueException;
use PHPUnit\Framework\TestCase;

class GovernmentTestScenarioTest extends TestCase
{
    /** @var StubGovTestScenario */
    private $stub;

    protected function setUp(): void
    {
        $this->stub = new StubGovTestScenario();
    }

    /** @test */
    public function it_gets_correct_valid_government_test_scenarios()
    {
        $this->assertEquals([
            StubGovTestScenario::DEFAULT,
            StubGovTestScenario::SIMPLE_CASE,
            StubGovTestScenario::COMPLEX_CASE,
        ], $this->stub->getValidGovTestScenarios());
    }

    /** @test */
    public function it_throws_exception_when_given_wrong_government_test_scenario()
    {
        $this->expectException(InvalidVariableValueException::class);

        $this->stub->checkValid('wrong');
    }

    /** @test */
    public function it_doesnt_throws_exception_when_given_correct_government_test_scenario()
    {
        $this->stub->checkValid(StubGovTestScenario::SIMPLE_CASE);

        $this->addToAssertionCount(1);
    }
}
