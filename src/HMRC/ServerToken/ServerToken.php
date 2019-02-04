<?php

namespace HMRC\ServerToken;

class ServerToken
{
    private static $instance = null;

    /** @var string */
    private $serverToken;

    private function __construct()
    {
        $this->serverToken = null;
    }

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get the server token.
     *
     * @return string|null
     */
    public function get()
    {
        return $this->serverToken;
    }

    /**
     * Set the server token.
     *
     * @param string $serverToken
     */
    public function set(string $serverToken)
    {
        $this->serverToken = $serverToken;
    }
}
