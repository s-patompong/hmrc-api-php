<?php

namespace HMRC\GovernmentTestScenario;

use HMRC\Helpers\VariableChecker;
use ReflectionClass;

abstract class GovernmentTestScenario
{
    /**
     * @throws \ReflectionException
     *
     * @return array
     */
    public function getValidGovTestScenarios(): array
    {
        $oClass = new ReflectionClass(static::class);

        $constants = $oClass->getConstants();

        return array_values($constants);
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
