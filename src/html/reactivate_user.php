<?php 

require '../vendor/autoload.php';

// see how we can make this as a singleton
$builder = new \Okta\ClientBuilder();
$client = $builder
            ->setToken('00MOi4ngIKE2ZnaleTevCIHUUqaYvnQG3slfZ6ZD81')
            ->setOrganizationUrl('https://dev-209822.oktapreview.com')
            ->build();

$user = new \Okta\Users\User();

try{
    // throw a ResourceException if it doesn't found the user
    $foundUser = $user->get('auser@example.com');
    var_dump($foundUser->activate());
} catch (Exception $e) {
    //TODO manage exception
}

echo '<pre>';
echo ( $e == NULL ? $foundUser : $e);
echo'</pre>';