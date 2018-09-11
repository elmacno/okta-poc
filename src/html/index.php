<?php 

require_once __DIR__ . '/../vendor/autoload.php';

define("APPLICATION_ROOT", \realpath(__DIR__ . "/.."));

$jwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiMTIzNDU2Nzg5MCIsImZpcnN0X25hbWUiOiJNYXRpYXMiLCJsYXN0X25hbWUiOiJDYWxjYWdubyJ9.oP6bHbrJRfmUlzmXFIzg1Emcp-7qP8a90fszYOj8j2M';

use Lcobucci\JWT\Parser;

$token = (new Parser())->parse((string) $jwt);
$token->getHeaders();
$token->getClaims();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <p>user id: <?= $token->getClaim('user_id') ?></p>
    <p>first name: <?= $token->getClaim('first_name') ?></p>
    <p>last name: <?= $token->getClaim('last_name') ?></p>
</body>
</html>