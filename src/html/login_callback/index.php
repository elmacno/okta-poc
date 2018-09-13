<?php

// Begin the PHP session so we have a place to store the username
session_start();

function http($url, $params=false) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    if($params)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    return json_decode(curl_exec($ch));
}

if (!isset($_GET['code'])) {
    die('An error occurred after signing in');
}

$client_id = '0oag8ydp2tj7NTaww0h7';
$client_secret = 'kAOmzdCF9_ATMP5zbtHskXEKeXl__xRFEqVRqAHc';
$metadata_url = 'https://dev-209822.oktapreview.com/oauth2/default/.well-known/oauth-authorization-server';

$metadata = http($metadata_url);

$authorization_code = $_GET['code'];

$response = http($metadata->token_endpoint, [
    'grant_type' => 'authorization_code',
    'code' => $authorization_code,
    'redirect_uri' => 'http://192.168.2.20/login_callback',
    'client_id' => $client_id,
    'client_secret' => $client_secret
]);

if (!isset($response->access_token)) {
    die('Error fetching access token');
}

$token = http($metadata->introspection_endpoint, [
    'token' => $response->access_token,
    'client_id' => $client_id,
    'client_secret' => $client_secret
]);

if($token->active == 1) {
    $_SESSION['username'] = $token->username;
    $_SESSION['access_token'] = $response->access_token;
    $_SESSION['id_token'] = $response->id_token;
    header('Location: /');
    die();
}