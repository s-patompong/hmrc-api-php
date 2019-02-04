<?php

namespace HMRC\Request;

use HMRC\Exceptions\EmptyServerTokenException;
use HMRC\ServerToken\ServerToken;

abstract class RequestWithServerToken extends Request
{
    /**
     * @throws EmptyServerTokenException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return \HMRC\Response\Response
     */
    public function fire()
    {
        $this->checkServerToken();

        return parent::fire();
    }

    protected function getHeaders(): array
    {
        return [
            RequestHeader::ACCEPT        => $this->getAcceptHeader(),
            RequestHeader::AUTHORIZATION => $this->getAuthorizationHeader(ServerToken::getInstance()->get()),
        ];
    }

    /**
     * @throws EmptyServerTokenException
     */
    private function checkServerToken()
    {
        if (is_null(ServerToken::getInstance()->get())) {
            throw new EmptyServerTokenException('Server token is empty, please set using ServerToken::getInstance()->set() method.');
        }
    }
}
