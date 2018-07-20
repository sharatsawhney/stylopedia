<?php 

$fb = new Facebook\Facebook([
  'app_id' => '860623400762480', // Replace {app-id} with your app id
  'app_secret' => 'db055fe4ba288b712e7fc69f81577eb9',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>