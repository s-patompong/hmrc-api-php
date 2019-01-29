<?php


namespace HMRC\Environment;


use HMRC\Exceptions\InvalidVariableValueException;

class Environment
{
    const ALLOWED_ENV = [ self::SANDBOX, self::LIVE ];

    const SANDBOX = 'sandbox';

    const LIVE = 'live';

    private static $instance = null;

    /** @var string */
    private $env;

    private function __construct()
    {
        $this->env = self::SANDBOX;
    }

    public static function getInstance(): Environment
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function reset()
    {
        self::$instance = new self;
    }

    public function getEnv(): string
    {
        return $this->env;
    }

    /**
     * @param string $env
     *
     * @throws InvalidVariableValueException
     */
    public function setEnv(string $env)
    {
        $this->checkEnv($env);

        $this->env = $env;
    }

    public function isSandbox(): bool
    {
        return $this->env == self::SANDBOX;
    }

    public function isLive(): bool
    {
        return $this->env == self::LIVE;
    }

    public function setToSandbox()
    {
        $this->env = self::SANDBOX;
    }

    public function setToLive()
    {
        $this->env = self::LIVE;
    }

    /**
     * @param string $env
     *
     * @throws InvalidVariableValueException
     */
    private function checkEnv(string $env)
    {
        if(!in_array($env, self::ALLOWED_ENV)) {
            $allowedValueString = implode(", ", self::ALLOWED_ENV);
            throw new InvalidVariableValueException("Invalid env, the allowed env are {$allowedValueString}.");
        }
    }
}
