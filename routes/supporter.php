<?php

# Register suppporter
$app->get('/get-started/supporter/register', function() use($app) {
    //TODO only find one suporter by login
    $app->render('create-supporter.php');
});

# Save supporter
$app->post('/save-supporter', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

        $req = $app->request->post();

       // @TODO check if email address already in system before saving
        $supporter = Supporter::find_by_email_address($req['email_address']);

        if (count($supporter) > 0) {
            $app->flash('success_info', 'Email already exists');

            $app->redirect('/get-started/supporter/register');
        }

       // @TODO id_follower_count is reference to follower_count table. Save to that instead
       $supporter = Supporter::create(
           array('user_name' => $req['username'], 'password' => $req['password'],'email_address'=>$req['email_address'],
               'id_follower_count'=>$req['followers_fb'] ,'country'=>$req['country']
          ));

        // Auto respond to to supporter
        $to = $req['email_address'];
        $subject = 'Welcome to Shareitcamp';
        $body = "Thanks for creating an account";
        $from = 'From: info@wilsonshop.biz';

        mail($to, $subject, $body, $from);

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
    $base_url = $app->config('configs')['base_url'];

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
        'success_info' => $success_info, 'base_url' => $base_url));
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

# show supported campaign individually
// @TODO add back authentication. Just when user not  logged in store their destination
$app->get('/supporter/campaign/:id', function ($id) use($app) {

    $base_url = $app->config('configs')['base_url'];

    # list supported campaigns
    $email = $app->view()->getData('user');
    $supporter = Supporter::find_by_email_address($email);
    $flash = $app->view()->getData('flash');

    $campaign = Campaign::find_by_campaign_id($id);

    $app->render('supporter/supported-campaign.php', array('campaign' => $campaign, 'base_url' => $base_url));
});

$app->post('/save-post-to-fb', $authenticate($app), function () use ($app) {

    if ($app->request->getMethod() == 'POST') {

        $configs = parse_ini_file('../config.ini');

        $req = $app->request->post();

        $fb = new Facebook\Facebook([
            'app_id' => $configs['fb_app_id'],
            'app_secret' => $configs['fb_app_secret'],
            'default_graph_version' => 'v2.2',
        ]);

        $linkData = [
            'link' => 'http://www.example.com',
            'message' => $req['message'],
        ];


        $helper = $fb->getRedirectLoginHelper();  

        try {
            // Returns a `Facebook\FacebookResponse` object
	  $accessToken = $helper->getAccessToken();  	
          $response = $fb->post('/me/feed', $linkData, $accessToken);

        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphNode = $response->getGraphNode();

        echo 'Posted with id: ' . $graphNode['id'];

        $app->flash('success_info', 'You are now supporting a new campaign');

        $app->redirect('/supporter/campaigns');

    }
});

# List rewards
$app->get('/rewards', $authenticate($app), function () use ($app){

    $rewards = Reward::find('all');

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    # Campaigns supported
    $email = $app->view()->getData('user');
    $supporter = Supporter::find_by_email_address($email);

    $supportedCampaigns = Campaign_response::find('all',
        array('conditions' => array('supporter_id in (?)', array($supporter->id_supporter))));

    $pointsEarned = count($supportedCampaigns) * 10;

    $app->render('list-rewards.php', array('rewards' => $rewards, 'success_info' => $success_info,
        'points_earned' => $pointsEarned));
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

