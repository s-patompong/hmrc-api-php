<?php


namespace HMRC\VAT;


use HMRC\Exceptions\MissingFieldsException;

abstract class VATPostRequest extends VATRequest
{
    public function __construct(string $vrn)
    {
        parent::__construct($vrn);
    }

    protected function getMethod()
    {
        return parent::METHOD_POST;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws MissingFieldsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \HMRC\Exceptions\InvalidEnvironmentException
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    public function fire()
    {
        $this->checkVATPostBody();

        return parent::fire();
    }

    protected function getOptions()
    {
        return array_merge([
            'json' => $this->getVATPostOptions(),
        ], parent::getOptions());
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

    abstract protected function getVATPostOptions();
    abstract protected function getRequiredClassAttributes();
}
