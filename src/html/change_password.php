<?php 

require '../vendor/autoload.php';



$builder = new \Okta\ClientBuilder();

// it's obligatory to create the client
$client = $builder
    ->setToken('00MOi4ngIKE2ZnaleTevCIHUUqaYvnQG3slfZ6ZD81')
    ->setOrganizationUrl('https://dev-209822.oktapreview.com')
    ->build();


/**
 * Change the user password
 *
 * @param string $username The id or username 
 * @param string $oldPassword The previous password of the user
 * @param string $newPassword The new password of the user
 * @return string Error exception or the user 
 */
function changePassword($username, $oldPassword, $newPassword){
    if ((strlen($oldPassword) == 0) || (strlen($newPassword) == 0))
        return "The passwords cannot be empty";

    $changePasswordRequest = new \Okta\Generated\Users\ChangePasswordRequest();

    // create a password credential with the old password
    $oldPasswordCredential = new \Okta\Users\PasswordCredential();
    $oldPasswordCredential->setValue($oldPassword);
    $changePasswordRequest->setOldPassword($oldPasswordCredential);

    // create a password credential with the new password
    $newPasswordCredential = new \Okta\Users\PasswordCredential();
    $newPasswordCredential->setValue($newPassword);
    $changePasswordRequest->setNewPassword($newPasswordCredential);
    
    try{
        $user = new \Okta\Users\User();
        // get() method can search by ID or email
        $foundUser = $user->get($username); 
        // call the method
        $foundUser->changePassword($changePasswordRequest);
    }catch (Okta\Exceptions\ResourceException $e){
        //TODO manage exception
        
    }

    return ( $e == NULL ? $foundUser : $e);
}


echo "<pre>";
echo changePassword('','','');
echo "</pre>";

