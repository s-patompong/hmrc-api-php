<?php

namespace HMRC\Oauth2;

use HMRC\Exceptions\InvalidVariableTypeException;
use HMRC\Exceptions\MissingAccessTokenException;
use League\OAuth2\Client\Token\AccessTokenInterface;

class AccessToken
{
    const SESSION_KEY = 'hmrc_access_token';

    public static function exists(): bool
    {
        return isset($_SESSION[self::SESSION_KEY]);
    }

    /**
     * @return AccessTokenInterface|null
     */
    public static function get()
    {
        return isset($_SESSION[self::SESSION_KEY]) ? unserialize($_SESSION[self::SESSION_KEY]) : null;
    }

    /**
     * @param $accessToken
     *
     * @throws InvalidVariableTypeException
     */
    public static function set($accessToken)
    {
        if ($accessToken instanceof AccessTokenInterface) {
            $accessToken = serialize($accessToken);
        }

        if (gettype($accessToken) !== 'string') {
            throw new InvalidVariableTypeException('Access token must be string or implement AccessTokenInterface.');
        }

        $_SESSION[self::SESSION_KEY] = $accessToken;
    }

    /**
     * @throws MissingAccessTokenException
     *
     * @return bool
     */
    public static function hasExpired(): bool
    {
        /** @var \League\OAuth2\Client\Token\AccessToken $accessToken */
        $accessToken = self::get();

        if (is_null($accessToken)) {
            throw new MissingAccessTokenException("Access token doesn't exists.");
        }

        return $accessToken->hasExpired();
    }
}
