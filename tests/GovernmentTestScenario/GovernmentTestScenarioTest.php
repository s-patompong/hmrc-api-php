<?php

namespace HMRC\Test\GovernmentTestScenario;

use PHPUnit\Framework\TestCase;

class GovernmentTestScenarioTest extends TestCase
{
    /** @var StubGovTestScenario */
    private $stub;

    protected function setUp()
    {
        $this->stub = new StubGovTestScenario();
    }

    /**
     * @test
     *
     * @throws \ReflectionException
     */
    public function it_gets_correct_valid_government_test_scenarios()
    {
        $this->assertEquals([
            StubGovTestScenario::DEFAULT,
            StubGovTestScenario::SIMPLE_CASE,
            StubGovTestScenario::COMPLEX_CASE,
        ], $this->stub->getValidGovTestScenarios());
    }

    /**
     * @test
     *
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function it_throws_exception_when_given_wrong_government_test_scenario()
    {
        $this->stub->checkValid('wrong');
    }

    /**
     * @test
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function it_doesnt_throws_exception_when_given_correct_government_test_scenario()
    {
        $this->stub->checkValid(StubGovTestScenario::SIMPLE_CASE);

        $this->addToAssertionCount(1);
    }
}
