<?php

namespace HMRC\Test\Helpers;

use HMRC\Exceptions\InvalidDateFormatException;
use HMRC\Helpers\DateChecker;
use PHPUnit\Framework\TestCase;

class DateCheckerTest extends TestCase
{
    /** @test */
    public function it_doesnt_throws_exception_when_given_correct_date_format()
    {
        DateChecker::checkDateStringFormat('2020-01-25', 'Y-m-d');

        $this->addToAssertionCount(1);
    }

    /** @test */
    public function it_throws_exception_when_given_wrong_date_format()
    {
        $this->expectException(InvalidDateFormatException::class);

        DateChecker::checkDateStringFormat('2020-01-25', 'Y');
    }
}
