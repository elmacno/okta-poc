<?php 

require '../vendor/autoload.php';

// it's obligatory to create the client
$builder = new \Okta\ClientBuilder();
$client = $builder
            ->setToken('00MOi4ngIKE2ZnaleTevCIHUUqaYvnQG3slfZ6ZD81')
            ->setOrganizationUrl('https://dev-209822.oktapreview.com')
            ->build();

$user = new \Okta\Users\User();
$okta = new \Okta\Okta();


//getLogs
try{
    // throw a ResourceException if it doesn't found the user
    $foundUser = $user->get('manuel.bertelli@eagleview.com');
    $userProfile = $foundUser->getProfile();
    $userDisplayName = $userProfile->getFirstName() . " " . $userProfile->getLastName();
    $foundUserLogs = $okta->getLogs(['query' => Array('filter' => 'eventType eq "user.session.start"  and outcome.result eq "SUCCESS" and actor.id eq "' . $foundUser->getId() . '"')]);

    $logs = $okta->getLogs(['query' => Array('filter' => 'eventType eq "user.session.start"  and outcome.result eq "SUCCESS"')]);

} catch (Exception $e) {
  echo ($e);
}

?>
<h1><?php echo($userDisplayName) ?> </h1>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Outcome</th>
    </tr>
  </thead>
  <tbody>

    <?php 
    foreach ($foundUserLogs as &$l) {
    ?>

    <tr>
      <td> <?php echo ($l->getActor()->getDisplayName());  ?> </td>
      <td> <?php echo ($l->getOutcome());  ?> </td>
    </tr>


    <?php  } ?>

  </tbody>
</table>

<h1>All Users: </h1>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Outcome</th>
    </tr>
  </thead>
  <tbody>

    <?php 
    foreach ($logs as &$l) {
    ?>

    <tr>
      <td> <?php echo ($l->getActor()->getDisplayName());  ?> </td>
      <td> <?php echo ($l->getOutcome());  ?> </td>
    </tr>


    <?php  } ?>

  </tbody>
</table>