<?php


namespace HMRC\VAT;


use HMRC\GovernmentTestScenario\GovernmentTestScenario;
use HMRC\Helpers\DateChecker;
use HMRC\Helpers\VariableChecker;

class RetrieveVATObligationsRequest extends VATGetRequest
{
    /** @var array possible statuses, O is open and F is fulfilled */
    const POSSIBLE_STATUSES = [ 'O', 'F' ];

    /** @var string from */
    protected $from;

    /** @var string to */
    protected $to;

    /** @var string status */
    protected $status;

    /**
     * VATObligationsRequest constructor.
     *
     * @param string $vrn VAT registration number
     * @param string $from correct format is YYYY-MM-DD, example 2019-01-25
     * @param string $to correct format is YYYY-MM-DD, example 2019-01-25
     * @param string|null $status correct status is O or F
     *
     * @throws \HMRC\Exceptions\InvalidDateFormatException
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     */
    public function __construct(string $vrn, string $from, string $to, string $status = null)
    {
        parent::__construct($vrn);

        DateChecker::checkDateStringFormat($from, 'Y-m-d');
        DateChecker::checkDateStringFormat($to, 'Y-m-d');

        $this->from = $from;
        $this->to = $to;
        $this->status = $status;

        if(!is_null($this->status)) {
            VariableChecker::checkPossibleValue($status, self::POSSIBLE_STATUSES);
        }
    }

    protected function getVatApiPath(): string
    {
        return "/obligations";
    }

    protected function getQueryString(): array
    {
        $queryArray = [
            'from' => $this->from,
            'to' => $this->to,
        ];

        if(!is_null($this->status)) {
            $queryArray['status'] = $this->status;
        }

        return $queryArray;
    }

    /**
     * Get class that deal with government test scenario
     *
     * @return GovernmentTestScenario
     */
    protected function getGovTestScenarioClass(): GovernmentTestScenario
    {
        return new RetrieveVATObligationsGovTestScenario;
    }
}
