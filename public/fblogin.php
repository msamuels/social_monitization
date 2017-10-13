<?php

require '../vendor/autoload.php';

    session_start();

    $fb = new Facebook\Facebook([
        'app_id' => $configs['fb_app_id'], // integer
        'app_secret' => $configs['fb_app_secret'], // string
        'default_graph_version' => 'v2.1',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    if (isset($_GET['state'])) {
        $helper->getPersistentDataHandler()->set('state', $_GET['state']);
    }

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

    $loginUrl = '';

    if(!isset($accessToken)) {
        $permissions = ['email']; // Optional permissions
        // foo
        $loginUrl = $helper->getLoginUrl($configs['base_url'].'/fblogin.php', $permissions);
        echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
    } else {

        try {
            $fb->setDefaultAccessToken($accessToken);

            // Logged in!
            //$_SESSION['facebook_access_token'] = (string) $accessToken;
            $response = $fb->get('/me?fields=email');
            $user = $response->getGraphUser();

        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $_SESSION['email'] = $user['email'];
        $_SESSION['user'] = 'fb-user';
        $_SESSION['user_type'] = 'supporter';

        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        $rurl = '/supporter/campaigns/pending';
        //var_dump($_SESSION);exit;

        //$app->redirect('/supporter/campaigns/pending');

        header('Location: '.$configs['base_url'].'/supporter/campaigns/pending?token='.$accessToken);

    }



?>      
