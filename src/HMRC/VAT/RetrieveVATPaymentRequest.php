<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;
use HMRC\Helpers\DateChecker;

class RetrieveVATPaymentRequest extends VATGetRequest
{
    private $from;

    private $to;

    /**
     * RetrieveVATLiabilities constructor.
     *
     * @param string $vrn
     * @param string $from
     * @param string $to
     *
     * @throws \HMRC\Exceptions\InvalidDateFormatException
     */
    public function __construct(string $vrn, string $from, string $to)
    {
        parent::__construct($vrn);

        DateChecker::checkDateStringFormat($from, 'Y-m-d');
        DateChecker::checkDateStringFormat($to, 'Y-m-d');

        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return array
     */
    protected function getQueryString(): array
    {
        return [
            'from' => $this->from,
            'to' => $this->to,
        ];
    }

    /**
     * Get class that deal with government test scenario.
     *
     * @return GovernmentTestScenario
     */
    protected function getGovTestScenarioClass(): GovernmentTestScenario
    {
        return new RetrieveVATPaymentGovTestScenario;
    }

    /**
     * Get VAT Api path, the path should be after {$this->vrn}.
     *
     * @return string
     */
    protected function getVatApiPath(): string
    {
        return "/payments";
    }
}
