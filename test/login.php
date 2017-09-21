<?php
if (!session_id()) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'php-graph-sdk/vendor/autoload.php'; 

$fb = new Facebook\Facebook([
  'app_id' => '1884021058580514', // Replace {app-id} with your app id
  'app_secret' => 'c0dad1ae0b4651f6d5b9197dff72fae8',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost:8888/GitHub/mybcabus/test/fb-callback.php', $permissions);
header("Location: $loginUrl");
?>
