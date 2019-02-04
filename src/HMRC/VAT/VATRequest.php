<?php

namespace HMRC\VAT;

use HMRC\GovernmentTestScenario\GovernmentTestScenario;
use HMRC\HTTP\Header;
use HMRC\Request\RequestHeader;
use HMRC\Request\RequestHeaderValue;
use HMRC\Request\RequestWithAccessToken;

abstract class VATRequest extends RequestWithAccessToken
{
    /** @var string VAT registration number */
    protected $vrn;

    /** @var string */
    protected $govTestScenario;

    public function __construct(string $vrn)
    {
        parent::__construct();

        $this->vrn = $vrn;
    }

    protected function getApiPath(): string
    {
        return "/organisations/vat/{$this->vrn}".$this->getVatApiPath();
    }

    protected function getHeaders(): array
    {
        $ownHeaders = [
            RequestHeader::CONTENT_TYPE => RequestHeaderValue::APPLICATION_JSON,
        ];

        if (!is_null($this->govTestScenario)) {
            $ownHeaders[Header::GOV_TEST_SCENARIO] = $this->govTestScenario;
        }

        return array_merge($ownHeaders, parent::getHeaders());
    }

    /**
     * @return mixed
     */
    public function getGovTestScenario()
    {
        return $this->govTestScenario;
    }

    /**
     * @param string $govTestScenario
     *
     * @throws \HMRC\Exceptions\InvalidVariableValueException
     * @throws \ReflectionException
     *
     * @return VATRequest
     */
    public function setGovTestScenario(string $govTestScenario): self
    {
        $this->govTestScenario = $govTestScenario;

        if (!is_null($this->govTestScenario)) {
            $this->getGovTestScenarioClass()->checkValid($this->govTestScenario);
        }

        return $this;
    }

    /**
     * Get class that deal with government test scenario.
     *
     * @return GovernmentTestScenario
     */
    abstract protected function getGovTestScenarioClass(): GovernmentTestScenario;

    /**
     * Get VAT Api path, the path should be after {$this->vrn}.
     *
     * @return string
     */
    abstract protected function getVatApiPath(): string;
}
