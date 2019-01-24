<?php


namespace HMRC\VAT;


use HMRC\Helpers\DateChecker;
use HMRC\Helpers\VariableChecker;
use HMRC\Request\RequestWithAccessToken;

class VATObligationsRequest extends VATGetRequest
{
    /** @var array possible statuses, O is open and F is fulfilled */
    const POSSIBLE_STATUSES = [ 'O', 'F' ];

    /** @var string from */
    protected $from;

    /** @var string to */
    protected $to;

    /** @var string status */
    protected $status;

    /** @var string test scenario */
    protected $govTestScenario;

    /**
     * VATObligationsRequest constructor.
     *
     * @param string $vrn VAT registration number
     * @param string $from correct format is YYYY-MM-DD, example 2019-01-25
     * @param string $to correct format is YYYY-MM-DD, example 2019-01-25
     * @param string|null $status correct status is O or F
     * @param string|null $govTestScenario scenario to test sandbox, see VATObligationsGovTestScenario class for valid scenarios
     *
     * @throws \HMRC\Exceptions\InvalidDateFormatException
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     */
    public function __construct(string $vrn, string $from, string $to, string $status = null, string $govTestScenario = null)
    {
        parent::__construct($vrn);

        DateChecker::checkDateStringFormat($from, 'Y-m-d');
        DateChecker::checkDateStringFormat($to, 'Y-m-d');

        $this->from = $from;
        $this->to = $to;
        $this->status = $status;
        $this->govTestScenario = $govTestScenario;

        if(!is_null($this->status)) {
            VariableChecker::checkPossibleValue($status, self::POSSIBLE_STATUSES);
        }

        if(!is_null($this->govTestScenario)) {
            VariableChecker::checkPossibleValue($govTestScenario, VATObligationsGovTestScenario::getValidGovTestScenarios());
        }
    }

    protected function getVatApiPath()
    {
        return "/obligations";
    }

    protected function getQueryStringArray()
    {
        $queryArray = [
            'from' => $this->from,
            'to' => $this->to,
        ];

        if(!is_null($this->status)) {
            $queryArray['status'] = $this->status;
        }

        if(!is_null($this->govTestScenario)) {
            $queryArray['Gov-Test-Scenario'] = $this->govTestScenario;
        }

        return $queryArray;
    }
}
