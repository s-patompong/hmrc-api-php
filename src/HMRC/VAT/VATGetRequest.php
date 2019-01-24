<?php


namespace HMRC\VAT;


use HMRC\Request\RequestWithAccessToken;

abstract class VATGetRequest extends VATRequest
{
    protected function getURI()
    {
        $uri = parent::getURI();

        $queryString = http_build_query($this->getQueryStringArray());

        return "{$uri}?{$queryString}";
    }

    protected function getMethod()
    {
        return parent::METHOD_GET;
    }

    /**
     * @return string
     */
    abstract protected function getQueryStringArray();
}
