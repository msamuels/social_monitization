<?php

# Supporter Login page
$app->get('/', function () use ($app){

    $options = array('limit' => 4);
    $campaigns = Campaign::all($options);

    $app->render('supporter-login.php', array('campaigns'=>$campaigns));
});

# Organizations page
$app->get('/organizations', function () use ($app){

    $app->render('frontpage/organizations.php');
});

# Organizations page
$app->get('/about-us', function () use ($app){

    $app->render('frontpage/about.php');
});
