<?php

# Supporter Login page
$app->get('/', function () use ($app){

	$options = array('limit' => 3);
    $campaigns = Campaign::all($options);

    $app->render('supporter-login.php', array('campaigns'=>$campaigns));
});

