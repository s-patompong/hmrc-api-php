<?php


namespace HMRC\VAT;


use HMRC\Exceptions\MissingFieldsException;
use HMRC\Request\RequestMethod;

abstract class VATPostRequest extends VATRequest
{
    public function __construct(string $vrn)
    {
        parent::__construct($vrn);
    }

    protected function getMethod(): string
    {
        return RequestMethod::POST;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws MissingFieldsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\MissingAccessTokenException
     */
    public function fire()
    {
        $this->checkVATPostBody();

        return parent::fire();
    }

    protected function getHTTPClientOptions(): array
    {
        return array_merge([
            'json' => $this->getVATPostBody(),
        ], parent::getHTTPClientOptions());
    }

    /**
     * @throws MissingFieldsException
     */
    protected function checkVATPostBody()
    {
        $missingFields = [];

        foreach ($this->getRequiredClassAttributes() as $field)
        {
            if(is_null($this->{$field})) {
                $missingFields[] = $field;
            }
        }

        if(count($missingFields) > 0) {
            $missingFieldsString = implode(", " , $missingFields);

            throw new MissingFieldsException("Missing fields {$missingFieldsString}, please set using class setter method.");
        }
    }

    abstract protected function getVATPostBody(): array;
    abstract protected function getRequiredClassAttributes(): array;
}
