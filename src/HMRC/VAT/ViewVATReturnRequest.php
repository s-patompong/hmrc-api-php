<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;

class ViewVATReturnRequest extends VATGetRequest
{
    /** @var string */
    private $periodKey;

    public function __construct(string $vrn, string $periodKey)
    {
        parent::__construct($vrn);

        $this->periodKey = $periodKey;
    }

    /**
     * @return array
     */
    protected function getQueryString(): array
    {
        return [];
    }

    protected function getVatApiPath(): string
    {
        return "/returns/{$this->periodKey}";
    }

    /**
     * Get class that deal with government test scenario.
     *
     * @return GovernmentTestScenario
     */
    protected function getGovTestScenarioClass(): GovernmentTestScenario
    {
        return new ViewVATReturnGovTestScenario;
    }
}
