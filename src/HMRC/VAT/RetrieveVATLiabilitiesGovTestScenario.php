<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;

class RetrieveVATLiabilitiesGovTestScenario extends GovernmentTestScenario
{
    const DEFAULT = null;

    /*
     * Returns a single valid liability when used with dates from 2017-01-02 and to 2017-02-02.
     */
    const SINGLE_LIABILITY = 'SINGLE_LIABILITY';

    /*
     * Returns multiple valid liabilities when used with dates from 2017-04-05 and to 2017-12-21.
     */
    const MULTIPLE_LIABILITIES = 'MULTIPLE_LIABILITIES';
}
