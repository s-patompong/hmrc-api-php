<?php


namespace HMRC\Response;


use GuzzleHttp\Psr7\Response as GuzzleResponse;
use HMRC\HTTP\Code;

class Response
{
    /** @var GuzzleResponse */
    private $response;

    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Check if the response is success
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->response->getStatusCode() == Code::SUCCESS;
    }

    /**
     * Get the response body
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getBody()
    {
        return $this->response->getBody();
    }

    /**
     * Get response body as JSON
     *
     * @param bool $assoc
     *
     * @return mixed
     */
    public function getJson(bool $assoc = false)
    {
        return json_decode($this->response->getBody()->getContents(), $assoc);
    }

    /**
     * Get response body as associate array
     *
     * @return mixed
     */
    public function getArray()
    {
        return $this->getJson(true);
    }

    /**
     * Echo out the response body with json header
     */
    public function echoBodyWithJsonHeader()
    {
        header("Content-Type: application/json");

        echo $this->getBody();
    }

    /**
     * @return GuzzleResponse
     */
    public function getGuzzleResponse(): GuzzleResponse
    {
        return $this->response;
    }
}
