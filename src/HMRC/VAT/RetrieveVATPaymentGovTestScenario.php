<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;

class RetrieveVATPaymentGovTestScenario extends GovernmentTestScenario
{
    const DEFAULT = null;

    /*
     * Returns a single valid payment when used with dates from 2017-01-02 and to 2017-02-02.
     */
    const SINGLE_PAYMENT = 'SINGLE_PAYMENT';

    /*
     * Returns multiple valid payments when used with dates from 2017-02-27 and to 2017-12-21.
     */
    const MULTIPLE_PAYMENTS = 'MULTIPLE_PAYMENTS';
}
