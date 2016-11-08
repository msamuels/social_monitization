<?php
require '../vendor/autoload.php';

$configs = parse_ini_file('../config.ini');

$fb = new Facebook\Facebook([
    'app_id' => $configs['fb_app_id'], // Replace {app-id} with your app id
    'app_secret' =>  $configs['fb_app_secret'],
    'default_graph_version' => 'v2.2',
    'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : 'APP-ID|APP-SECRET'
]);

$response = $fb->get('/me?fields=id,name', $token);
$user = $response->getGraphUser();


var_dump($user);exit;

echo 'Name: ' . $user['name'];

$_SESSION['email'] = $user['email'];
$_SESSION['user'] = $user['name'];
$_SESSION['user_type'] = 'supporter';
exit;
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
header('Location: '.$configs['base_url'].'/supporter/campaigns/pending');


