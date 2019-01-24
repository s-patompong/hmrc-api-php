<?php


namespace HMRC\VAT;


use HMRC\Request\RequestWithAccessToken;

abstract class VATRequest extends RequestWithAccessToken
{
    /** @var string VAT registration number */
    protected $vrn;

    public function __construct(string $vrn)
    {
        parent::__construct();

        $this->vrn = $vrn;
    }

    protected function getApiPath()
    {
        return "/organisations/vat/{$this->vrn}" . $this->getVatApiPath();
    }

    protected function getHeaders()
    {
        $parentHeaders = parent::getHeaders();

        return array_merge([
            parent::HEADER_CONTENT_TYPE => parent::HEADER_VALUE_APPLICATION_JSON,
        ], $parentHeaders);
    }

    abstract protected function getVatApiPath();
}
