<?php

require '../vendor/autoload.php';

use Lcobucci\JWT\Parser;

// Begin the PHP session so we have a place to store the username
session_start();

$token = null;

if (!isset($_SESSION['access_token'])) {
  header("Location: /login");
  die();
} else {
  $token = (new Parser())->parse((string) $_SESSION['access_token']); // Parses from a string
  $token->getHeaders(); // Retrieves the token header
  $token->getClaims(); // Retrieves the token claims
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Main Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php if ($token) { ?>
    <h4>Token Claims</h4>
    <ul>
      <li><strong>JTI: </strong><?= $token->getClaim('jti') ?></li>
      <li><strong>ISS: </strong><?= $token->getClaim('iss') ?></li>
      <li><strong>AUD: </strong><?= $token->getClaim('aud') ?></li>
      <li><strong>IAT: </strong><?= $token->getClaim('iat') ?></li>
      <li><strong>EXP: </strong><?= $token->getClaim('exp') ?></li>
      <li><strong>CID: </strong><?= $token->getClaim('cid') ?></li>
      <li><strong>UID: </strong><?= $token->getClaim('uid') ?></li>
      <li><strong>SCP: </strong><?= $token->getClaim('scp') ?></li>
      <li><strong>SUB: </strong><?= $token->getClaim('sub') ?></li>
    </ul>
    <a href="/logout">Log out</a>
  <?php } else { ?>
    <p>Not Logged In</P>
    <a href="/login">Log in</a>
  <?php } ?>
</body>
</html>