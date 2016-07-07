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

    $email = $app->request()->post('email');
    $password = $app->request()->post('password');
    $user_type = $app->request()->post('user_type');
    $client = null;

    $errors = array();

    // check the user type to know when model to request from
    if($email == 'admin'){
        $client = Owner::find_by_username($email);
        $user_type = "admin";
    }else {

        if ($user_type == "supporter") {
            $client = Supporter::find_by_email_address($email);
        } elseif($user_type == "producer") {
            $client = Producer::find_by_email_address($email);
        }
    }

    // is the user even in the system
    if ($client != null) {
        if ($password != $client->password) {
            $app->flash('email', $email);
            $errors['password'] = "Password does not match.";
        }
    } else {
        $errors['email'] = "Email is not found.";
    }

    if (count($errors) > 0) {
        $app->flash('errors', $errors);

        $app->redirect('/login');
    }

    $_SESSION['user'] = $email;
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
   $email_value = $email_error = $password_error = '';
   if (isset($flash['email'])) {
      $email_value = $flash['email'];
   }
   if (isset($flash['errors']['email'])) {
      $email_error = $flash['errors']['email'];
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
    $loginUrl = $helper->getLoginUrl($configs['app_url'].'/fb-callback.php', $permissions);

   $app->render('login.php', array('error' => $error, 'email_value' => $email_value,
      'email_error' => $email_error, 'password_error' => $password_error, 'urlRedirect' => $urlRedirect,
       'fb_login_url' => $loginUrl));
});

// log user out
$app->get("/logout", function () use ($app) {

   unset($_SESSION['user']);
   unset($_SESSION['user_type']);

   $app->view()->setData('user', null);
   $app->redirect('/');
});
