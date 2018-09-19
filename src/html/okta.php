<?php

require '../vendor/autoload.php';

try {
  $builder = new \Okta\ClientBuilder();
  $client = $builder
              ->setToken('00MOi4ngIKE2ZnaleTevCIHUUqaYvnQG3slfZ6ZD81')
              ->setOrganizationUrl('https://dev-209822.oktapreview.com')
              ->build();

  echo '$client:';
  echo '<pre>';
  print_r($client);
  echo '</pre>';
} catch (Exception $e) {
  echo $e;
}

echo "Here!";


