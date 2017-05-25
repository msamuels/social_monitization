<?php

# Register suppporter
$app->get('/get-started/supporter/register', function() use($app) {

    $path = explode('/', $app->request->getPath());


    $my_nonprofit = '';
    $my_school = '';

    $non_profits = Organization::find('all', array('conditions' => array('type in (?)', 'non-profit')));

    $success_info = NULL;
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('create-supporter.php', array('path' => $path, 'non_profits' => $non_profits));
});

# Save supporter
$app->post('/save-supporter', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

        $req = $app->request->post();

        $supporter = Supporter::find_by_email_address($req['email_address']);

        if (count($supporter) > 0) {
            $app->flash('success_info', 'Email already exists');

            $app->redirect('/get-started/supporter/register');
        }

       // @TODO id_follower_count is reference to follower_count table. Save to that instead

        $password = password_hash($req['password'], PASSWORD_DEFAULT);

       $supporter = Supporter::create(
           array('user_name' => $req['username'], 'password' => $password,'email_address'=>$req['email_address'],
               'id_follower_count'=>$req['followers_fb'] ,'country'=>$req['country']
          ));


        // Save organization affiliation information
        if(($req['organization_affiliation'] != '--')) {

            $supporter_org = Organization_affiliation::create(
                array('supporter_id' => $supporter->id_supporter, 'organization_id' => $req['organization_affiliation']
                ));

        }

        // Save school affiliation information
        if($req['school_affiliation'] != '--') {
            $supporter_school = Organization_affiliation::create(
                array('supporter_id' => $supporter->id_supporter, 'organization_id' => $req['school_affiliation']
                ));
        }

        // Auto respond to to supporter
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: info@shareitcamp.com' . "\r\n";

        $to = $req['email_address'];
        $subject = 'Welcome to shareitcamp!';

        $baseurl =  $destination = $app->config('configs')['base_url'];

        $body = "<p>Thank you for joining this effort. We will notify you of new campaigns via email so please be on the
            lookout.<p>";
        $body .= "<p>Don't want to wait until then? Great. Here are 2 ways you can get a head start:</p>";

        $body .= "<p>1) Go to shareitcamp and support us as your first campaign! Just click here.</p>";

        $body .= "<a href='https://www.shareitcamp.com/supporter/campaign/1'>Click here to support</a>";

        $body .= "<p>2) Like us on Facebook</p>";

        $body .= "<a href='https://www.facebook.com/shareitcamp'>shareitcamp</a>";

        $body .= "<p>Thanks, <br />
        The shareitcamp team</p>";

        $from = 'From: info@shareitcamp.com';

        mail($to, $subject, $body, $headers);

        $app->flash('success_info', 'Thank you for signing up to support. Please check your email for a welcome notification.');

        $app->redirect('/login');

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
    $user_name = $app->view()->getData('user');
    $supporter = Supporter::find_by_user_name($user_name);
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
        'success_info' => $success_info, 'base_url' => $base_url, 'isPending' => false));
});


# Allow the user to select a campaign to support
$app->get('/supporter/campaigns/pending', $authenticate($app), function () use ($app){
    
    // Get suporter. Join on campaign_response and get all the campaign ids already supported
    // Get all campaigns where the supporter hasn't supported
    $user_name = $app->view()->getData('user');
    $supporter = Supporter::find_by_user_name($user_name);

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
        $campaigns = Campaign::find('all',array('order' => 'campaign_id DESC'));
    } else {
        $campaigns = Campaign::find('all', array('conditions' => array('campaign_id NOT IN (?) AND approved = ?
        ORDER BY campaign_id DESC', $ar_campaigns, 'Y')));
    }

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('support-campaigns.php', array('campaigns' => $campaigns, 'user_id' => $supporter->id,
        'isPEnding' => true, 'success_info' => $success_info));
});


$app->post('/save-campaign-support', $authenticate($app), function () use ($app) {

    if ($app->request->getMethod() == 'POST') {
	
        // @TODO check if supporter already supporting that campaign
        $req = $app->request->post();
        $campaignSupport = Campaign_response::create(
            array('campaign_id' => $req['campaign_id'], 'supporter_id' => $req['supporter_id']));

        $campaign = Campaign::find_by_campaign_id($req['campaign_id']);
        $supporter = Supporter::find_by_id_supporter($req['supporter_id']);

        // Auto respond to to supporter
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: info@shareitcamp.com' . "\r\n";

        $baseurl =  $destination = $app->config('configs')['base_url'];

        $to = $supporter->email_address;
        $subject = 'Shareitcamp: Thanks for your support';

        $body = "Thank you for agreeing to support ".$campaign->campaign_name.". Please click on the link below to go
            the campaign page . Once there, click on the <i>share on Facebook</i> link. <p>For sharing the link you will earn 5
            points. </p>";

        $body .= "<a href='".$baseurl."/supporter/campaign/".$campaign->friendly_url."'>Click here to support</a>";

        $body .= "<p>Thanks, <br />
        The shareitcamp team</p>";

        mail($to, $subject, $body, $headers);
        
        $app->flash('success_info', 'Click on the Facebook share icon to share the campaign. Thank you.');

        $app->redirect('/supporter/campaigns');

    }
});

// supporter/campaign
// @TODO add back authentication. Just when user not  logged in store their destination
$app->get('/supporter/campaign/:id_title', function ($id_title) use($app) {

    $base_url = $app->config('configs')['base_url'];

    # list supported campaigns
    $user_name = $app->view()->getData('user');
    $supporter = Supporter::find_by_user_name($user_name);
    $flash = $app->view()->getData('flash');

    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    if(is_numeric($id_title)) {
            $campaign = Campaign::find_by_campaign_id($id_title);
    } else {
        $campaign = Campaign::find_by_friendly_url($id_title);
    }

    $reward = Reward::find_by_campaign_id($campaign->campaign_id);

    $producer = $campaign->getProducer();

    $supportedCampaigns = Campaign_response::find('all',
        array('conditions' => array('supporter_id in (?) AND campaign_id in (?)',
            $supporter->id_supporter, $campaign->campaign_id)));

    $isPending = false;
    if(count ($supportedCampaigns ) == 0){
        $isPending = true;
    }

    $app->render('supporter/supported-campaign.php', array('campaign' => $campaign, 'base_url' => $base_url,
        'reward' => $reward, 'producer' => $producer, 'isPending' => $isPending,  'user_id' => $supporter->id,
        'supportedCampaigns' => $supportedCampaigns, 'success_info' => $success_info));
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

    $rewards = Reward::find('all',array('order' => 'reward_id desc'));

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    # Campaigns supported
    $user_name = $app->view()->getData('user');
    $supporter = Supporter::find_by_user_name($user_name);

    $supportedCampaigns = Campaign_response::find('all',
        array('conditions' => array('supporter_id in (?)', array($supporter->id_supporter))));

    // get assoicated ccampaigns
    $campaign_ids = array();
    $campaigns = array();

    if(count($supportedCampaigns) > 0 ) {

        foreach ($supportedCampaigns as $campaign) {
            $campaign_ids[] = $campaign->campaign_id;
        }

        $campaigns = Campaign::find('all',
            array('conditions' => array('campaign_id in (?)', $campaign_ids)));
    }

    // rewards claimed
    $rewards_claimed = Reward_claimed::find_all_by_id_supporter($supporter->id_supporter);

    $reward_claimed_value = 0;

    // find value of rewards that were claimed
    if(count($rewards_claimed) > 0 ) {

        if(count($rewards_claimed) == 1) {
            $rewards_claimed = array($rewards_claimed);
        }

        foreach($rewards_claimed as $rc) {
            $reward_claimed_value += $rc->point_value;
        }
    }

    // total points of supported campaigns
    $total_campaign_points_earned = 0;

    if(count($campaigns) > 0 ) {
        foreach($campaigns as $c) {
            $total_campaign_points_earned += $c->points;
        }
    }

    // subtract total pts from campaigns supported from claimed points
    $points_remaining = $total_campaign_points_earned - $reward_claimed_value;

    $rewards_track = array('points_earned' => $total_campaign_points_earned,
        'points_claimed' => $reward_claimed_value, 'points_remaining' => $points_remaining);

    $app->render('supporter/list-rewards.php', array('rewards' => $rewards, 'success_info' => $success_info,
        'rewards_track' => $rewards_track));
});

$app->get('/supporter/manage-account', $authenticate($app), function () {
    echo "Get Started";
});

// profile
$app->get('/supporter/manage-account/profile', $authenticate($app), function () {   
    echo "Get Started";
});

$app->get('/supporter/manage-account/payment-options', $authenticate($app), function () {
    echo "Get Started";
});

# Save supporter
$app->post('/save-campaign-post-link', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

        $req = $app->request->post();

        $campaign_response = Campaign_response::find('all', array('conditions' => array('campaign_id = ? AND 
        supporter_id = ?', $req['campaign_id'], $req['supporter_id'])));

        // TODO maybe do a loop over the campaign responses. dont just update the first one
        $response = $campaign_response[0]->update_attributes(
            array('campaign_response' => $req['post-link']
            ));

        // Auto respond to to supporter
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: info@shareitcamp.com' . "\r\n";

        $to = 'info@shareitcamp.com';
        $subject = 'Campaign response (post link) added to shareitcamp';

        $body = "<p>A supporter has added the link to their post<p>".$req['post-link'];

        $body .= "<p>Thanks, <br />
        The shareitcamp team</p>";

        mail($to, $subject, $body, $headers);

        $app->flash('success_info', 'Supporter Saved');

        $app->redirect('/supporter/campaign/'.$req['campaign_id']);

    }

});

// Edit account info
$app->get("/my-account", $authenticate($app), function () use ($app) {

    $user_name = $app->view()->getData('user');
    $supporter = Supporter::find_by_user_name($user_name);
    $flash = $app->view()->getData('flash');

    // get all the organizations for displays
    $orgs = Organization::find('all');

    $schools = array();
    $nonprofits = array();

    foreach($orgs as $org) {
        if($org->type == 'non-profit') {
            $nonprofits[] = $org;
        } else {
            $schools[] = $org;
        }
    }

    // get the organization affiliation
    $affiliations = Organization_affiliation::find_all_by_supporter_id($supporter->id_supporter);

    // get the ids and query the Org table by them.
    $vals = array();
    foreach($affiliations as $af) {
        $vals[] = $af->organization_id;
    }

    // find out what organization they are affiliated with.

    $my_nonprofit = '';
    $my_school = '';

    if(count($vals) > 0) {
        $my_affiliations = Organization::find('all', array('conditions' => array('organization_id in (?)', $vals)));

        if(count($my_affiliations) > 0) {
            foreach($my_affiliations as $my_affiliation) {
                if($my_affiliation->type == 'non-profit') {
                    $my_nonprofit = $my_affiliation->name;
                } else {
                    $my_school = $my_affiliation->name;
                }
            }
        }
    }

    // get all the organizations for displays
    $orgs = Organization::find('all');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('supporter/account.php', array('supporter' => $supporter,
        'nonprofits' => $nonprofits, 'schools' => $schools, 'affiliations' => $affiliations,
        'my_nonprofit'=> $my_nonprofit, 'my_school'=> $my_school, 'success_info' => $success_info, 'orgs' => $orgs));
});


# Update account
$app->post('/update-account', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

        $req = $app->request->post();

        $user_name = $app->view()->getData('user');
        $supporter = Supporter::find_by_user_name($user_name);

        $fields_to_update = array('id_follower_count' => $req['num_followers']);

        if(trim($req['password']) != ""){
            $fields_to_update['password'] = password_hash($req['password'], PASSWORD_DEFAULT);
        }

        $resp = $supporter->update_attributes(
            $fields_to_update
        );

        // if no organization affiliation selected just move on.
        if($req['organization_affiliation'] != '') {

            // update organization afflition as well
            $org_fields = array('organization_id' => $req['organization_affiliation']);
            $organization = Organization_affiliation::find_by_supporter_id($supporter->id_supporter);

		    $create_org_fields = array('organization_id' => $req['organization_affiliation'],
                'supporter_id' => $supporter->id_supporter);

            if(count($organization) == 0) {
                Organization_affiliation::create($create_org_fields);
            } else {
                $organization->update_attributes($org_fields);
            }

        }



        $app->flash('success_info', 'Account updated');

        $app->redirect('/my-account');

    }

});

$app->get('/claim-rewards/:reward_id',  $authenticate($app), function ($reward_id) use ($app){

    $user_name = $app->view()->getData('user');
    $supporter = Supporter::find_by_user_name($user_name);

    $reward = Reward::find_by_reward_id($reward_id);

    $supportedCampaigns = Campaign_response::find('all',
        array('conditions' => array('supporter_id in (?)', array($supporter->id_supporter))));

    // get assoicated ccampaigns
    $campaign_ids = array();
    $campaigns = array();

    foreach ($supportedCampaigns as $campaign) {
        $campaign_ids[] = $campaign->campaign_id;
    }

    if(count($supportedCampaigns) > 0 ) {
        $campaigns = Campaign::find('all',
            array('conditions' => array('campaign_id in (?)', $campaign_ids)));
    }
    // rewards claimed
    $rewards_claimed = Reward_claimed::find_all_by_id_supporter($supporter->id_supporter);

    $reward_claimed_value = 0;

    // check if this reward is among the ones claimed
    $reward_ids = array();

    // find value of rewards that were claimed
    if(count($rewards_claimed) > 0 ) {

        if(count($rewards_claimed) == 1) {
            $rewards_claimed = array($rewards_claimed);
        }

        foreach($rewards_claimed as $rc) {
            $reward_claimed_value += $rc->point_value;
            $reward_ids[] = $rc->reward_id;
        }
    }

    $is_reward_claimed = in_array($reward_id, $reward_ids);

    // total points of supported campaigns
    $total_campaign_points_earned = 0;

    if(count($campaigns) > 0 ) {

        foreach($campaigns as $c) {
            $total_campaign_points_earned += $c->points;
        }
    }

    // subtract total pts from campaigns supported from claimed points
    $points_remaining = $total_campaign_points_earned - $reward_claimed_value;

    $rewards_track = array('points_earned' => $total_campaign_points_earned,
        'points_claimed' => $reward_claimed_value, 'points_remaining' => $points_remaining);

    $app->render('supporter/claim-rewards.php', array('supporter' => $supporter, 'reward' => $reward,
        'rewards_track' => $rewards_track, 'is_reward_claimed' => $is_reward_claimed));
});

# Update account
$app->post('/do-claim-reward', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

        $req = $app->request->post();

        $reward = Reward::find_by_reward_id($req['reward_id']);

        $user_name = $app->view()->getData('user');
        $supporter = Supporter::find_by_user_name($user_name);

        $offer_code = rand(1111111111,9999999999);

        // @TODO Add entry to reward_claimed table and judge points remainder from that
        $reward_claimed = Reward_claimed::create(
            array('id_supporter' => $supporter->id_supporter, 'reward_id' => $reward->reward_id,
                'point_value' => $reward->point_value, 'date_claimed' => date("Y-m-d h:i:sa"), 'offer_code' => $offer_code));

        // Auto respond to to supporter
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: info@shareitcamp.com ' . "\r\n";

        $to = $supporter->email_address;
        $subject = 'Reward claim'. $reward->reward_name;

        // Send supporter a different message if its a reward or a raffle.
        if($reward->type == "reward") {
            $body = "<p>You are about to claim this reward: ".$reward->reward_name.".</p>.";
            $body .= "<p> Our admin has been notified and will be emailing you your gift card. </p>";
        } else {
            $body = "<p>You are about to enter this raffle: ".$reward->reward_name.".</p>.";
            $body .= "<p> One supporter will be selected at random as the winner. </p>";
            $body .= "<p> Here is your raffle ticket number: ".$reward->offer_code."</p>";
        }

        $service_body = "<p>".$supporter->email_address." wants to claim this reward: ".$reward->reward_name.".</p>.";

        $body .= "<p>Thanks, <br />
        The shareitcamp team</p>";

        // email service to let them know new reward was claimed
        mail('info@shareitcamp.com', $subject, $service_body, $headers);

        // email supporter that they have claimed their reward
        mail($to, $subject, $body, $headers);

        $app->flash('success_info', 'Account updated');

        $app->redirect('/reward-thank-you');

    }

});

// Edit account info
$app->get("/reward-thank-you", function () use ($app) {

    $user_name = $app->view()->getData('user');
    $supporter = Supporter::find_by_user_name($user_name);
    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('supporter/reward-thank-you.php', array('supporter' => $supporter, 'success_info' => $success_info));
});

$app->post("/supporter/email-claim-points", function () use ($app) {

    $email_username = $app->request()->post('email-username');
    $req = $app->request->post();

    $campaign = Campaign::find_by_campaign_id($req['campaign_id']);

    $supporter = Supporter::find_by_email_address($email_username);

    if ($supporter == NULL) {
            $supporter = Supporter::find_by_user_name($email_username);
    } 

    if($supporter == NULL) {
            // The user doesn't exist
            $app->flash('success_info', 'Thank you for your support.');
            $app->redirect('/supporter/campaign/'.$campaign->friendly_url);
    }


    // Check if the user has already supported the campaign
    $is_supported = Campaign_response::find('all',
        array('conditions' => array('supporter_id in (?) AND campaign_id in (?)',
            $supporter->id_supporter, $campaign->campaign_id)));

        if ($is_supported) {
            $app->flash('success_info', 'Thank you for your support.');
            $app->redirect('/supporter/campaign/'.$campaign->friendly_url);
        }

    //@TODO move this logic to a central place
    $campaignSupport = Campaign_response::create(
        array('campaign_id' => $req['campaign_id'], 'supporter_id' => $supporter->id_supporter));



    // Auto respond to to supporter
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: info@shareitcamp.com' . "\r\n";

    $baseurl =  $destination = $app->config('configs')['base_url'];

    $to = $supporter->email_address;
    $subject = 'Shareitcamp: Thanks for your support';

    $body = "Thank you for agreeing to support ".$campaign->campaign_name.". You have earned 5
            points! Login in to see how many reward points you have earned</p>";

    $body .= "<a href='".$baseurl."/rewards'>Click here to support</a>";

    $body .= "<p>Thanks, <br />
        The shareitcamp team</p>";

    mail($to, $subject, $body, $headers);

    $app->flash('success_info', 'Thank you for you support. You have earned 5 points.');

    $app->redirect('/supporter/campaign/'.$campaign->friendly_url);

});
