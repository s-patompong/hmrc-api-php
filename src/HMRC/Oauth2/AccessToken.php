<?php


namespace HMRC\Oauth2;


use HMRC\Exceptions\HMRCException;
use League\OAuth2\Client\Token\AccessTokenInterface;

class AccessToken
{
    public static function exists()
    {
        return isset($_SESSION[ 'access_token' ]);
    }

    public static function get()
    {
        return isset($_SESSION[ 'access_token' ]) ? unserialize($_SESSION[ 'access_token' ]) : null;
    }

    public static function set(string $serializedAccessToken)
    {
        $_SESSION[ 'access_token' ] = $serializedAccessToken;
    }

    /**
     * @return bool
     * @throws HMRCException
     */
    public static function hasExpired()
    {
        /** @var \League\OAuth2\Client\Token\AccessToken $accessToken */
        $accessToken = self::get();

        if(is_null($accessToken)) {
            throw new HMRCException("Access token doesn't exists.");
        }

        return $accessToken->hasExpired();
    }
}
