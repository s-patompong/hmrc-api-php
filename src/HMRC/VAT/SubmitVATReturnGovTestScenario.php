<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;

class SubmitVATReturnGovTestScenario extends GovernmentTestScenario
{
    const DEFAULT = null;

    /**
     * Submission has not passed validation. Invalid parameter VRN.
     */
    const INVALID_VRN = 'INVALID_VRN';

    /**
     * Submission has not passed validation. Invalid parameter PERIODKEY.
     */
    const INVALID_PERIODKEY = 'INVALID_PERIODKEY';

    /**
     * Submission has not passed validation. Invalid parameter Payload.
     */
    const INVALID_PAYLOAD = 'INVALID_PAYLOAD';

    /**
     * The remote endpoint has indicated that VAT has already been submitted for that period.
     */
    const DUPLICATE_SUBMISSION = 'DUPLICATE_SUBMISSION';

    /**
     * The remote endpoint has indicated that the submission is for a tax period that has not ended.
     */
    const TAX_PERIOD_NOT_ENDED = 'TAX_PERIOD_NOT_ENDED';
}
