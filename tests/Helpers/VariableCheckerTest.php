<?php


namespace HMRC\Test\Helpers;


use HMRC\Helpers\VariableChecker;
use PHPUnit\Framework\TestCase;

class VariableCheckerTest extends TestCase
{
    /**
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     */
    public function testItThrowExceptionWhenVariableIsNotInArray()
    {
        VariableChecker::checkPossibleValue(1, [ 2, 3 ]);
    }

    /**
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     */
    public function testItDoesNotThrowExceptionWhenVariableIsInArray()
    {
        VariableChecker::checkPossibleValue(1, [ 1, 2 ]);

        $this->addToAssertionCount(1);
    }
}
