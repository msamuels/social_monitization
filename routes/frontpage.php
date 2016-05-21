<?php

# Supporter Login page
$app->get('/', function () use ($app){

    $options = array('limit' => 4);
    $campaigns = Campaign::all($options);

    $app->render('supporter-login.php', array('campaigns'=>$campaigns));
});

