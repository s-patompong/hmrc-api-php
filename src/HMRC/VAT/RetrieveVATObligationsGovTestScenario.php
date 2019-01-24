<?php


namespace HMRC\VAT;


use ReflectionClass;

class RetrieveVATObligationsGovTestScenario
{
    /**
     * Simulates the scenario where the client has quarterly obligations and one is fulfilled
     */
    const DEFAULT = null;

    /**
     * Simulates the scenario where the client has quarterly obligations and none are fulfilled
     */
    const QUARTERLY_NONE_MET = 'QUARTERLY_NONE_MET';

    /**
     * Simulates the scenario where the client has quarterly obligations and one is fulfilled
     */
    const QUARTERLY_ONE_MET = 'QUARTERLY_ONE_MET';

    /**
     * Simulates the scenario where the client has quarterly obligations and two are fulfilled
     */
    const QUARTERLY_TWO_MET = 'QUARTERLY_TWO_MET';

    /**
     * Simulates the scenario where the client has quarterly obligations and three are fulfilled
     */
    const QUARTERLY_THREE_MET = 'QUARTERLY_THREE_MET';

    /**
     * Simulates the scenario where the client has quarterly obligations and four are fulfilled
     */
    const QUARTERLY_FOUR_MET = 'QUARTERLY_FOUR_MET';

    /**
     * Simulates the scenario where the client has monthly obligations and none are fulfilled
     */
    const MONTHLY_NONE_MET = 'MONTHLY_NONE_MET';

    /**
     * Simulates the scenario where the client has monthly obligations and one month is fulfilled
     */
    const MONTHLY_ONE_MET = 'MONTHLY_ONE_MET';

    /**
     * Simulates the scenario where the client has monthly obligations and two months are fulfilled
     */
    const MONTHLY_TWO_MET = 'MONTHLY_TWO_MET';

    /**
     * Simulates the scenario where the client has monthly obligations and three months are fulfilled
     */
    const MONTHLY_THREE_MET = 'MONTHLY_THREE_MET';

    /**
     * Simulates the scenario where no data is found
     */
    const NOT_FOUND = 'NOT_FOUND';

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getValidGovTestScenarios()
    {
        $oClass = new ReflectionClass(__CLASS__);

        return array_values($oClass->getConstants());
    }
}
