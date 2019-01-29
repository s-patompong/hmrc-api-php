<?php


namespace HMRC\VAT;


abstract class VATGetRequest extends VATRequest
{
    protected function getURI(): string
    {
        $uri = parent::getURI();

        $queryStringArray = $this->getQueryString();

        if(count($queryStringArray) == 0) {
            return $uri;
        }

        $queryString = http_build_query($queryStringArray);

        return "{$uri}?{$queryString}";
    }

    protected function getMethod(): string
    {
        return parent::METHOD_GET;
    }

    /**
     * @return array
     */
    abstract protected function getQueryString(): array;
}
