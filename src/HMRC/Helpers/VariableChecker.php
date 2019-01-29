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

        $possibleValuesWithoutNull = array_filter($possibleValues, function($value) {
            return !is_null($value);
        });

        $connectWord = 'values are';
        if(count($possibleValuesWithoutNull) == 1) {
            $connectWord = 'value is';
        }

        throw new InvalidVariableValueException("Invalid variable value, the allowed {$connectWord} " . implode(",", $possibleValuesWithoutNull));
    }
}
