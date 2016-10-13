<?php

# Supporter Login page
$app->get('/', function () use ($app){

    $options = array('limit' => 4,  'order' => 'campaign_id desc', 'conditions' => array("approved = 'Y'"));
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

// producer page
$app->get('/:name', function ($name) use ($app){

    //find the prducer by name
    $producer = Producer::find_by_friendly_url($name);

    // get the campaigns for this producer
    $options = array('conditions' => array("id_producer = $producer->id_producer"));
    $producer_campaigns = Account::all($options);

    // loop
    $campaign_ids = array();
    foreach ($producer_campaigns as $pc) {
        $campaign_ids[] = $pc->campaign_id;
    }

    // find campaigns for that producet
    $options_2 = array('order' => 'campaign_id desc', 'conditions' => array('campaign_id in (?)', $campaign_ids));
    $campaigns = Campaign::all($options_2);

    $app->render('frontpage/producer-campaigns.php', array('campaigns'=>$campaigns, 'producer'=>$producer));
});