<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;

class SubmitVATReturnRequest extends VATPostRequest
{
    public function __construct(string $vrn, SubmitVATReturnPostBody $postBody)
    {
        parent::__construct($vrn, $postBody);
    }

    protected function getVatApiPath(): string
    {
        return '/returns';
    }

    /**
     * Get class that deal with government test scenario.
     *
     * @return GovernmentTestScenario
     */
    protected function getGovTestScenarioClass(): GovernmentTestScenario
    {
        return new SubmitVATReturnGovTestScenario;
    }
}
