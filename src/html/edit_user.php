<?php 

require '../vendor/autoload.php';

// it's obligatory to create the client
$builder = new \Okta\ClientBuilder();
$client = $builder
            ->setToken('00MOi4ngIKE2ZnaleTevCIHUUqaYvnQG3slfZ6ZD81')
            ->setOrganizationUrl('https://dev-209822.oktapreview.com')
            ->build();

$user = new \Okta\Users\User();

// get() method can search by ID or email
$foundUser = $user->get('auser@example.com');
$profile = $foundUser->getProfile();

// edit custom attributes
$profile->reddit = 'auserexamplecom';

// edit default attributes
$profile->setEmail("auser3@example.com");
$profile->setLogin("auser3@example.com");
$profile->setLastName("Perez2");
$profile->setFirstName("Ausera");

// set the profile to the current user
$foundUser->setProfile($profile);

// save the user in Okta
$foundUser->save();

echo "<pre>";
echo $foundUser;
echo "</pre>";

echo "<pre>";
echo $profile;
echo "</pre>";
