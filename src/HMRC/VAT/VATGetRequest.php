<?php


namespace HMRC\VAT;


abstract class VATGetRequest extends VATRequest
{
    protected function getURI()
    {
        $uri = parent::getURI();

        $queryStringArray = $this->getQueryStringArray();

        if(count($queryStringArray) == 0) {
            return $uri;
        }

        $queryString = http_build_query($queryStringArray);

        return "{$uri}?{$queryString}";
    }

    protected function getMethod()
    {
        return parent::METHOD_GET;
    }

    /**
     * @return array
     */
    abstract protected function getQueryStringArray();
}
