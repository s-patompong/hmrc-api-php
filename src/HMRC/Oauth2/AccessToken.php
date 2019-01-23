<?php


namespace HMRC\Oauth2;


use League\OAuth2\Client\Token\AccessTokenInterface;

class AccessToken
{
    public static function exists()
    {
        return isset($_SESSION[ 'access_token' ]);
    }

    public static function get(): AccessTokenInterface
    {
        return $_SESSION[ 'access_token' ];
    }

    public static function set(AccessTokenInterface $accessToken)
    {
        $_SESSION[ 'access_token' ] = $accessToken;
    }

    public static function hasExpired()
    {
        /** @var \League\OAuth2\Client\Token\AccessToken $accessToken */
        $accessToken = static::get();

        return $accessToken->hasExpired();
    }
}
