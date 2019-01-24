<?php


namespace HMRC\Helpers;



use HMRC\Exceptions\InvalidDateFormatException;

class DateChecker
{
    /**
     * @param string $dateString
     * @param string $format
     *
     * @throws InvalidDateFormatException
     */
    public static function checkDateStringFormat(string $dateString, string $format)
    {
        $date = \DateTime::createFromFormat($format, $dateString);
        if($date && $date->format($format) == $dateString) {
            return;
        }

        throw new InvalidDateFormatException("Date string {$dateString} has invalid format, correct format is {$format}");
    }
}
