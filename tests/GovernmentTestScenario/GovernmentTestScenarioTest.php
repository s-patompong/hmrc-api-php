<?php


namespace HMRC\Test\GovernmentTestScenario;


use PHPUnit\Framework\TestCase;

class GovernmentTestScenarioTest extends TestCase
{
    /** @var StubGovTestScenario */
    private $stub;

    protected function setUp()
    {
        $this->stub = new StubGovTestScenario;
    }

    /**
     * @throws \ReflectionException
     */
    public function testItGetCorrectAllowedScenarios()
    {
        $this->assertEquals($this->stub->getValidGovTestScenarios(), [
            StubGovTestScenario::DEFAULT,
            StubGovTestScenario::SIMPLE_CASE,
            StubGovTestScenario::COMPLEX_CASE,
        ]);
    }

    /**
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function testItThrowExceptionWithWrongScenario()
    {
        $this->stub->checkValid('wrong');
    }

    /**
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function testItDoesNotThrowExceptionWithWrongScenario()
    {
        $this->stub->checkValid(StubGovTestScenario::SIMPLE_CASE);
        $this->addToAssertionCount(1);
    }
}
