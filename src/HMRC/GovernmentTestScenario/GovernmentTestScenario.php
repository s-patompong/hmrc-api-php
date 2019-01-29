<?php


namespace HMRC\GovernmentTestScenario;


use HMRC\Helpers\VariableChecker;
use ReflectionClass;

abstract class GovernmentTestScenario
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getValidGovTestScenarios()
    {
        $oClass = new ReflectionClass(__CLASS__);

        return array_values($oClass->getConstants());
    }

    /**
     * @param $govTestScenario
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function checkValid($govTestScenario)
    {
        VariableChecker::checkPossibleValue($govTestScenario, $this->getValidGovTestScenarios());
    }
}
