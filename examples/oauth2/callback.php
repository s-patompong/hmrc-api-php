<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../helpers.php";

session_start();

\HMRC\Oauth2\Provider::saveAccessTokenAndRedirectBackToCaller();

