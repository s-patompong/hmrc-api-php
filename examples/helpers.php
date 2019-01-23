<?php

function baseURL()
{
    return (isset($_SERVER[ 'HTTPS' ]) && $_SERVER[ 'HTTPS' ] === 'on' ?
            "https" : "http") . "://" . $_SERVER[ 'HTTP_HOST' ];
}
