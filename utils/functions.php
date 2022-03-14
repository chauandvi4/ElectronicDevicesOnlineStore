<?php

use \Firebase\JWT\JWT;

function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
{

    $str = str_replace('_', '', ucwords($string, '_'));

    if (!$capitalizeFirstCharacter) {
        $str = lcfirst($str);
    }

    return $str;
}

function sendOutput($data, $httpHeaders = array())
{
    header_remove('Set-Cookie');

    if (is_array($httpHeaders) && count($httpHeaders)) {
        foreach ($httpHeaders as $httpHeader) {
            header($httpHeader);
        }
    }

    echo $data;
    exit;
}

function sendOutputOk($responseData)
{
    sendOutput(
        $responseData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
    );
}

/** 
 * Get header Authorization
 * */
function getAuthorizationHeader()
{
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

/**
 * get access token from header
 * */
function getBearerToken()
{
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

function decodeToken()
{
    $jwt = getBearerToken();
    if ($jwt) {
        return JWT::decode($jwt, $GLOBALS['key'], array('HS256'));
    }

    return null;
}

function isLoggedIn()
{
    $data = decodeToken();

    if ($data) {
        return $data;
    } else {
        throw new Exception401();
    }
}

function isAdmin()
{
    $data = decodeToken();

    if ($data && $data->data->is_admin) {
        return $data;
    }

    throw new Exception401();
}
