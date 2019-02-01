<?php


namespace HMRC\Test\VAT;


use HMRC\Request\Request;
use HMRC\Request\RequestMethod;
use HMRC\Test\Request\RequestTest;

class RetrieveVATObligationsRequestTest extends RequestTest
{
    private $vrn;

    public function __construct()
    {
        parent::__construct();

        $this->vrn = uniqid();
    }

    public function testItEqual()
    {
        $this->assertEquals(1, 1);
    }

    protected function getCorrectPath()
    {
        return "/organisations/vat/{$this->vrn}/obligations";
    }

    protected function getCorrectMethod()
    {
        return RequestMethod::GET;
    }
}
