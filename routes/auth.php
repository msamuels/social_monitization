<?php

$authenticate = function ($app) {
    return function () use ($app) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['urlRedirect'] = $app->request()->getPathInfo();
            $app->flash('error', 'Login required');
            $app->redirect('/login');
        }
    };
};

$app->hook('slim.before.dispatch', function() use ($app) { 
   $user = null;
   if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];
   }
   $app->view()->setData('user', $user);
});


$app->post("/login", function () use ($app) {

    $username = $app->request()->post('username');
    $password = $app->request()->post('password');
    $user_type = $app->request()->post('user_type');//echo $user_type;exit;
    $client = null;

    $errors = array();

    // check the user type to know when model to request from
    if($username == 'admin'){
        $client = Owner::find_by_username($username);
        $user_type = "admin";
    }else {

        if ($user_type == "supporter") {
            $client = Supporter::find_by_user_name($username);
        } elseif($user_type == "producer") {
            $client = Producer::find_by_user_name($username);
        }
    }

    // is the user even in the system
    if ($client != null) {
        if (!password_verify($password, $client->password)) {
            $app->flash('username', $username);
            $errors['password'] = "Password does not match.";
        }
    } else {
        $errors['email'] = "Email is not found.";
    }

    if (count($errors) > 0) {
        $app->flash('errors', $errors);

        $app->redirect('/login');
    }

    $_SESSION['user'] = $username;
    $_SESSION['user_type'] = $user_type;

    if (isset($_SESSION['urlRedirect'])) {
       $tmp = $_SESSION['urlRedirect'];
       unset($_SESSION['urlRedirect']);
       $app->redirect($tmp);
    }

    if ($user_type == "supporter") {
        $app->redirect('/supporter/campaigns/pending');
    }elseif($user_type == "admin"){
        $app->redirect('/create-reward  ');
    }else{
        $app->redirect('/create-campaign');
    }

});


// present login screen to user
$app->get("/login", function () use ($app) {

   $configs = parse_ini_file('../config.ini');

   $flash = $app->view()->getData('flash');
   $error = '';	
   if (isset($flash['error'])) {
      $error = $flash['error'];
   }
   $urlRedirect = '/';
   if ($app->request()->get('r') && $app->request()->get('r') != '/logout' && $app->request()->get('r') != '/login') {
      $_SESSION['urlRedirect'] = $app->request()->get('r');
   }
   if (isset($_SESSION['urlRedirect'])) {
      $urlRedirect = $_SESSION['urlRedirect'];
   }
   $username_value = $username_error = $password_error = '';
   if (isset($flash['username'])) {
       $username_value = $flash['username'];
   }
   if (isset($flash['errors']['username'])) {
      $username_error = $flash['errors']['username'];
   }
   if (isset($flash['errors']['password'])) {
      $password_error = $flash['errors']['password'];
   }

    $fb = new Facebook\Facebook([
        'app_id' => $configs['fb_app_id'], // Replace {app-id} with your app id
        'app_secret' => $configs['fb_app_secret'],
        'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl($configs['app_url'].'/fb-callback', $permissions);

   $app->render('login.php', array('error' => $error, 'username_value' => $username_value,
      'username_error' => $username_error, 'password_error' => $password_error, 'urlRedirect' => $urlRedirect,
       'fb_login_url' => $loginUrl, 'configs' => $configs));
});

// log user out
$app->get("/logout", function () use ($app) {

   unset($_SESSION['user']);
   unset($_SESSION['user_type']);

   $app->view()->setData('user', null);
   $app->redirect('/');
});

// forgot password
$app->get("/forgot-password", function () use ($app) {

    $app->render('auth/forgot-password.php');
});

$app->post("/reset-password", function () use ($app) {

    $email = $app->request()->post('email');

    $client = Supporter::find_by_email_address($email);

    // generate new random password
    $rand_str = random_str(8);
    $password = password_hash($rand_str, PASSWORD_DEFAULT);

    // update user email in db
    $client->update_attributes(
        array('password' => $password));

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: info@shareitcamp.com' . "\r\n";

    // email user new password
    $body = 'You have requested a new password. Here it is: <strong>'.$rand_str. '</strong>';
    $body .= 'Please login with your username: '.$client->user_name . ' and your new password <br />';
    $body .= "<a href='https://www.shareitcamp.com/login'>Login</a> <br />";
    $body .= ' If you did not request this password please email info@shareitcamp.com';

    mail($client->email_address, 'Shareitcamp password reset', $body, $headers);

    $app->redirect('/login');

});

/**
 * Generate a random string, using a cryptographically secure
 * pseudorandom number generator (random_int)
 *
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 *
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters to select from
 * @return string
 */
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

// forgot password
$app->get("/fb-callback", function () use ($app) {


    $configs = $app->config('configs');

    $fb = new Facebook\Facebook([
        'app_id' => $configs['fb_app_id'], // Replace {app-id} with your app id
        'app_secret' =>  $configs['fb_app_secret'],
        'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    try {
        $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    if (! isset($accessToken)) {
        if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
        }
        exit;
    }

// Logged in
    echo '<h3>Access Token</h3>';
    var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    echo '<h3>Metadata</h3>';
    var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
    $tokenMetadata->validateAppId($configs['fb_app_id']); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
    $tokenMetadata->validateExpiration();

    if (! $accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
        try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
            exit;
        }

        echo '<h3>Long-lived</h3>';
        var_dump($accessToken->getValue());
    }

    $_SESSION['fb_access_token'] = (string) $accessToken;

// try to get logged in user info
    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me?fields=id,name', '{access-token}');
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

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


});
