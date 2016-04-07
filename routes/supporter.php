<?php

$app->get('/get-started/supporter/login', function () {
    echo "Get Started";
});

# Register suppporter
$app->get('/get-started/supporter/register', function() use($app) {
    //TODO only find one suporter by login
    $app->render('create-supporter.php');
});

# Save supporter
$app->post('/save-supporter', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

       // @TODO check if email address already in system before saving
       // @TODO id_follower_count is reference to follower_count table. Save to that instead
       $req = $app->request->post();
       $supporter = Supporter::create(
           array('user_name' => $req['username'], 'password' => $req['password'],'email_address'=>$req['email_address'],
               'interests'=>$req['interests'],'id_follower_count'=>$req['followers_fb'] ,'country'=>$req['country']
          ));

        $app->redirect('/supporters');

    }

});

# List supporters
$app->get('/supporters', function () use ($app){
    # list supporters
    $supporters = Supporter::find('all');
    $app->render('list-supporters.php', array('supporters' => $supporters));
});

$app->get('/supporter/campaigns', function () use($app) {
    # list supported campaigns
    $supportedCampaigns = Campaign_response::find('all');
    foreach($supportedCampaigns as $supportedCampaign) {
        $campaign = Campaign::find($supportedCampaign->id);
        $supportedCampaign->setCampaign($campaign);
    }
    $app->render('supported-campaigns.php', array('supported_campaigns' => $supportedCampaigns));
});

# Allow the user to select a campaign to support
# Have this page show both pending and campaigns to approve
$app->get('/supporter/campaigns/pending', function () use ($app){
    # list producers
    $campaigns = Campaign::find('all');
    $app->render('support-campaigns.php', array('campaigns' => $campaigns));
});

$app->post('/save-campaign-support', function () use ($app) {

    if ($app->request->getMethod() == 'POST') {

        // @TODO check if supporter already supporting that campaign
        $req = $app->request->post();
        $campaignSupport = Campaign_response::create(
            array('campaign_id' => $req['campaign_id'], 'supporter_id' => $req['supporter_id']));

        $app->redirect('/supporter/campaigns/pending');

    }
});


$app->get('/supporter/manage-account', function () {
    echo "Get Started";
});

$app->get('/supporter/manage-account/profile', function () {
    echo "Get Started";
});

$app->get('/supporter/manage-account/payment-options', function () {
    echo "Get Started";
});

