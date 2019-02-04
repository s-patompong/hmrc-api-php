<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;

class ViewVATReturnGovTestScenario extends GovernmentTestScenario
{
    const DEFAULT = null;

    /**
     * The date of the requested return cannot be further than four years from the current date.
     */
    const DATE_RANGE_TOO_LARGE = 'DATE_RANGE_TOO_LARGE';
}
