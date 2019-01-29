<?php


namespace HMRC\Test\Helpers;


use HMRC\Exceptions\InvalidDateFormatException;
use HMRC\Helpers\DateChecker;
use HMRC\VAT\SubmitVATReturnRequest;
use PHPUnit\Framework\TestCase;

class DateCheckerTest extends TestCase
{
    /**
     * @throws InvalidDateFormatException
     */
    public function testValidDateStringFormat()
    {
        DateChecker::checkDateStringFormat("2020-01-25", "Y-m-d");

        $this->addToAssertionCount(1);
    }

    /**
     * @expectedException \HMRC\Exceptions\InvalidDateFormatException
     */
    public function testInvalidDateStringFormat()
    {
        DateChecker::checkDateStringFormat("2020-01-25", "Y");
    }
}
