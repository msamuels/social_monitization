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

        $app->flash('success_info', 'Supporter Saved');

        $app->redirect('/supporters');

    }

});

# List supporters
$app->get('/supporters', $authenticate($app), function () use ($app){
    # list supporters
    $supporters = Supporter::find('all');

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('list-supporters.php', array('supporters' => $supporters, 'success_info' => $success_info));
});


$app->get('/supporter/campaigns', $authenticate($app), function () use($app) {

    # list supported campaigns
    $email = $app->view()->getData('user');
    $supporter = Supporter::find_by_email_address($email);
    $flash = $app->view()->getData('flash');

    $supportedCampaigns = Campaign_response::find('all',
	 array('conditions' => array('supporter_id in (?)', array($supporter->id_supporter))));

    // grab the associated campaigns
    foreach($supportedCampaigns as $supportedCampaign) {
        $campaign = Campaign::find($supportedCampaign->campaign_id);
        $supportedCampaign->setCampaign($campaign);
    }

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('supported-campaigns.php', array('supported_campaigns' => $supportedCampaigns,
        'success_info' => $success_info));
});


# Allow the user to select a campaign to support
$app->get('/supporter/campaigns/pending', $authenticate($app), function () use ($app){
    
    // Get suporter. Join on campaign_response and get all the campaign ids already supporter
    // Get all campaigns where the supporter hasn't supported
    $email = $app->view()->getData('user');
    $supporter = Supporter::find_by_email_address($email);

    $query = "SELECT cr.* FROM supporters s
	INNER JOIN campaign_responses cr 
	ON s.id_supporter=cr.supporter_id
	WHERE cr.supporter_id = ".$supporter->id_supporter;

    $ar_campaigns = array();

    $campaign_response = Campaign_response::find_by_sql($query);

    if (count($campaign_response > 0)) {
        foreach ($campaign_response as $cr) {
            $ar_campaigns[] = $cr->campaign_id;
        }
    }

    # list campaigns
    if (count($ar_campaigns) == 0) {
        // if they aren't supporting any campaigns return them all
        $campaigns = Campaign::find('all');
    } else {
        $campaigns = Campaign::find('all', array('conditions' => array('campaign_id NOT IN (?)', $ar_campaigns)));
    }
    $app->render('support-campaigns.php', array('campaigns' => $campaigns, 'user_id' => $supporter->id));
});


$app->post('/save-campaign-support', $authenticate($app), function () use ($app) {

    if ($app->request->getMethod() == 'POST') {
	
        // @TODO check if supporter already supporting that campaign
        $req = $app->request->post();
        $campaignSupport = Campaign_response::create(
            array('campaign_id' => $req['campaign_id'], 'supporter_id' => $req['supporter_id']));

        $app->flash('success_info', 'You are now supporting a new campaign');

        $app->redirect('/supporter/campaigns');

    }
});


$app->get('/supporter/manage-account', $authenticate($app), function () {
    echo "Get Started";
});

$app->get('/supporter/manage-account/profile', $authenticate($app), function () {
    echo "Get Started";
});

$app->get('/supporter/manage-account/payment-options', $authenticate($app), function () {
    echo "Get Started";
});

