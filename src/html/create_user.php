<?php 

require '../vendor/autoload.php';

// it's obligatory to create the client
$builder = new \Okta\ClientBuilder();
$client = $builder
            ->setToken('00MOi4ngIKE2ZnaleTevCIHUUqaYvnQG3slfZ6ZD81')
            ->setOrganizationUrl('https://dev-209822.oktapreview.com')
            ->build();

$user = new \Okta\Users\User();

// set user profile
$profile = new \Okta\Users\UserProfile();
$profile->setFirstName('John')
    ->setLastName('User')
    ->setLogin('auser@example.com')
    ->setEmail('auser@example.com');
$user->setProfile($profile);

// set user password
$password = new \Okta\Users\PasswordCredential();
$password->setValue('Abcd1234!');

// set recovery question
$recoveryQuestion = new \Okta\Users\RecoveryQuestionCredential();
$recoveryQuestion->setQuestion('What Language do I write in?')
    ->setAnswer('PHP!');

// set authentication provider
$provider = new \Okta\Users\AuthenticationProvider();
$provider->setName('OKTA')
    ->setType('OKTA');

// generate and the user credentials
$credentials = new \Okta\Users\UserCredentials();
$credentials->setPassword($password);
$credentials->setRecoveryQuestion($recoveryQuestion);
$credentials->setProvider($provider);
$user->setCredentials($credentials);

// create the user
try{
    $user->create();
    // after create the user, it enable to set the group
    // becuase in this moment, okta return an id
    $user->addToGroup('00gg8xkdq383xe5He0h7');
} catch (Exception $e){
   //TODO manage exception
}

echo '<pre>';
echo ( $e == NULL ? $user : $e);
echo'</pre>';
