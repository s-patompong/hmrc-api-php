<?php

namespace HMRC\Test\Helpers;

use HMRC\Exceptions\InvalidVariableValueException;
use HMRC\Helpers\VariableChecker;
use PHPUnit\Framework\TestCase;

class VariableCheckerTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception_when_given_invalid_variable_value()
    {
        $this->expectException(InvalidVariableValueException::class);

        VariableChecker::checkPossibleValue(1, [2, 3]);
    }

    /**
     * @test
     */
    public function it_doesnt_throws_exception_when_given_correct_variable_value()
    {
        VariableChecker::checkPossibleValue(1, [1, 2]);

        $this->addToAssertionCount(1);
    }
}
