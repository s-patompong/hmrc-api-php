<?php


namespace HMRC\Helpers;


use HMRC\Exceptions\InvalidVariableValueException;

class VariableChecker
{
    /**
     * @param $variable
     * @param array $possibleValues
     *
     * @throws InvalidVariableValueException
     */
    public static function checkPossibleValue($variable, array $possibleValues)
    {
        if(in_array($variable, $possibleValues)) {
            return;
        }

        throw new InvalidVariableValueException("Variable doesn't have value allowed in possible value " . implode(",", $possibleValues));
    }
}
