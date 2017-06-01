<?php

# Supporter Login page
$app->get('/', function () use ($app){

    $options = array('limit' => 7,  'order' => 'campaign_id desc', 'conditions' => array("approved = 'Y'"));

    if(isset($app->config('configs')['excluded_from_home'])) {

        $excluded_from_home = $app->config('configs')['excluded_from_home'];

        $options = array('order' => 'campaign_id desc', 'conditions' => array("approved = 'Y'
        AND campaign_id NOT IN (?) ", $excluded_from_home ));
    }

    $campaigns = Campaign::all($options);

    $app->render('frontpage/home-page.php', array('campaigns'=>$campaigns));
});

# Organizations page
$app->get('/organizations', function () use ($app){

    $app->render('frontpage/organizations.php');
});

# About us page
$app->get('/about-us', function () use ($app){

    $app->render('frontpage/about.php');
});

# FAQ page
$app->get('/faqs', function () use ($app){

    $app->render('frontpage/faq.php');
});

# FAQ page
$app->get('/privacy-policy', function () use ($app){

    $app->render('frontpage/privacy-policy.php');
});


# Terms and conditions 
$app->get('/termsandconditions', function () use ($app){     
    // point to the template file that has the code for page    
    $app->render('frontpage/termsandconditions.php'); 
});
