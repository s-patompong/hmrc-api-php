<?php

namespace HMRC\TestUser;

class CreateOrganisationRequest extends AbstractRequest
{
    protected function getApiPath(): string
    {
        return '/create-test-user/organisations';
    }
}
