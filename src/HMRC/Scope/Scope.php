<?php


namespace HMRC\Scope;


class Scope
{
    /** @var string hello scope */
    const HELLO = 'hello';

    /** @var string read:vat scope https://developer.service.hmrc.gov.uk/api-documentation/docs/api/service/vat-api/1.0#_retrieve-vat-obligations_get_accordion */
    const VAT_READ = 'read:vat';
}
