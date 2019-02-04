<?php

namespace HMRC\Test\Helpers;

use HMRC\Helpers\VariableChecker;
use PHPUnit\Framework\TestCase;

class VariableCheckerTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException \HMRC\Exceptions\InvalidVariableValueException
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     */
    public function it_throws_exception_when_given_invalid_variable_value()
    {
        VariableChecker::checkPossibleValue(1, [2, 3]);
    }

    /**
     * @test
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     */
    public function it_doesnt_throws_exception_when_given_correct_variable_value()
    {
        VariableChecker::checkPossibleValue(1, [1, 2]);

        $this->addToAssertionCount(1);
    }
}
