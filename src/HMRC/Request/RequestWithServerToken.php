<?php


namespace HMRC\Request;


abstract class RequestWithServerToken extends Request
{
    /** @var string */
    protected $serverToken;

    public function __construct(string $serverToken)
    {
        parent::__construct();

        $this->serverToken = $serverToken;
    }

    protected function getHeaders(): array
    {
        return [
            parent::HEADER_ACCEPT => $this->getAcceptHeader(),
            parent::HEADER_AUTHORIZATION => $this->getAuthorizationHeader($this->serverToken),
        ];
    }
}
