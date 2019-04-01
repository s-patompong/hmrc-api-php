<?php

namespace HMRC\TestUser;

class CreateAgentRequest extends AbstractRequest
{
    protected function getApiPath(): string
    {
        return '/create-test-user/agents';
    }
}
