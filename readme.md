# HMRC API PHP
[![Build Status](https://travis-ci.org/s-patompong/hmrc-api-php.svg?branch=master)](https://travis-ci.org/s-patompong/hmrc-api-php)

This library can be used to connect and does operations on HMRC API https://developer.service.hmrc.gov.uk/api-documentation.

## How to use
For global API such as Hello World, you can use HelloWorldRequest class to deal with the API call.

```php
<?php

$request = new \HMRC\Hello\HelloWorldRequest;

// Response is instant of HMRCResponse class
$response = $request->fire();

return $response->getBody();
```

For application-restricted API call such as Hello Application. First set the server token using ServerToken class and then you can use HelloApplicationRequest class to call the API.

```php
<?php

// ServerToken is singleton so please use getInstance() method to get an instance and then use set method on it
\HMRC\ServerToken\ServerToken::getInstance()->set($_GET['server_token']);

$request = new \HMRC\Hello\HelloApplicationRequest;
$response = $request->fire();

return $response->getBody();
```

For user-restricted API call, please see the next section.

## User-Restricted API call
The easiest way to learn about this is by running the local server using `php -S localhost:8080` command at the root of this library. And then navigate to http://localhost:8080/examples/index.php on your browser. Don't forget to setup the credentials inside examples/config.php file.
```php
<?php

$clientId = 'clientid';
$clientSecret = 'clientsecret';
$serverToken = 'servertoken';
```
You can gain the access token by create HMRC Oauth2 Provider and redirect to authorize URL (see example/oauth2/create-access-token.php for example).

```php
<?php

$callbackUri = "http://localhost:8080/examples/oauth2/callback.php" ;

$_SESSION[ 'client_id' ] = $_GET[ 'client_id' ];
$_SESSION[ 'client_secret' ] = $_GET[ 'client_secret' ];
$_SESSION[ 'callback_uri' ] = $callbackUri;
$_SESSION[ 'caller' ] = "/examples/index.php";

$provider = new \HMRC\Oauth2\Provider(
    $_GET[ 'client_id' ],
    $_GET[ 'client_secret' ],
    $callbackUri
);
$scope = [ \HMRC\Scope\Scope::VAT_READ, \HMRC\Scope\Scope::HELLO, \HMRC\Scope\Scope::VAT_WRITE ];
$provider->redirectToAuthorizationURL($scope);
```
After user grant authorize on HMRC authorization page, it will redirect back to `$callbackUri`, which in the example above, the callback.php file.

Content of callback.php
```php
<?php

$provider = new \HMRC\Oauth2\Provider(
    $_SESSION[ 'client_id' ],
    $_SESSION[ 'client_secret' ],
    $_SESSION[ 'callback_uri' ]
);

// Try to get an access token using the authorization code grant.
$accessToken = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

\HMRC\Oauth2\AccessToken::set($accessToken);

header("Location: /examples/index.php");
exit;
```
You need to use `\HMRC\Oauth2\AccessToken` class to get and set access token. The class that do the request will get Access Token from this class.

After get the access token and save it inside `\HMRC\Oauth2\AccessToken`, we can start calling user-restricted API. For example, here is the request to hello user endpoint.
```php
<?php

$request = new \HMRC\Hello\HelloUserRequest;
$response = $request->fire();

return $response->getBody();
```
## Change between sandbox and live environment
In default mode, this library will talk with `sandbox` environment of HMRC. If you want to use live environment, you can call it via `Environment` singleton.
```php
<?php

\HMRC\Environment\Environment::getInstance()->setToLive();
```
## Development & Contribution
Contributor is more than welcome to help develop this library, all the important methods should have unit test.

To run test, simply call `composer run-script test` command on terminal.
