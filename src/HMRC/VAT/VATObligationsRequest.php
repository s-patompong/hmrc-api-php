<?php


namespace HMRC\VAT;


use HMRC\Helpers\DateChecker;
use HMRC\Helpers\VariableChecker;
use HMRC\Request\RequestWithAccessToken;

class VATObligationsRequest extends RequestWithAccessToken
{
    /** @var array possible statuses, O is open and F is fulfilled */
    const POSSIBLE_STATUSES = [ 'O', 'F' ];

    /** @var string VAT registration number */
    private $vrn;

    /** @var string from */
    private $from;

    /** @var string to */
    private $to;

    /** @var string status */
    private $status;

    /** @var string test scenario */
    private $govTestScenario;

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
     * @throws \ReflectionException
     */
    public function __construct(string $vrn, string $from, string $to, string $status = null, string $govTestScenario = null)
    {
        parent::__construct();

        DateChecker::checkDateStringFormat($from, 'Y-m-d');
        DateChecker::checkDateStringFormat($to, 'Y-m-d');

        $this->vrn = $vrn;
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

    protected function getMethod()
    {
        return parent::METHOD_GET;
    }

    protected function getApiPath()
    {
        return "/organisations/vat/{$this->vrn}/obligations";
    }

    protected function getURI()
    {
        $uri = parent::getURI();

        $queryString = $this->getQueryString();

        return "{$uri}?{$queryString}";
    }

    protected function getHeaders()
    {
        $parentHeaders = parent::getHeaders();

        return array_merge([
            parent::HEADER_CONTENT_TYPE => parent::HEADER_VALUE_APPLICATION_JSON,
        ], $parentHeaders);
    }

    private function getQueryString()
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

        return http_build_query($queryArray);
    }

    private function getValidGovTestScenarios()
    {
        return [
            'QUARTERLY_NONE_MET',
            'QUARTERLY_ONE_MET',
            'QUARTERLY_TWO_MET',
            'QUARTERLY_THREE_MET',
            'QUARTERLY_FOUR_MET',
            'MONTHLY_NONE_MET',
            'MONTHLY_ONE_MET',
            'MONTHLY_TWO_MET',
            'MONTHLY_THREE_MET',
            'NOT_FOUND',
        ];
    }

}
