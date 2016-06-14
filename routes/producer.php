<?php

# Create producers
$app->get('/create-producer', function () use ($app){
    $app->render('create-producers.php');
});

# Save producers
$app->post('/save-producer', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

       // @TODO check if email address already in system before saving
       $req = $app->request->post();
       $producer = Producer::create(
           array('first_name' => $req['first_name'], 'last_name' => $req['last_name'], 'user_name' => $req['user_name'],
		'password' => $req['password'], 'org_name'=>$req['org_name'],'organization_url'=>$req['organization_url'],
               'email_address'=>$req['email_address'], 'description'=>$req['description'], 'country'=>$req['country']));

        $app->flash('success_info', 'Producer Saved');

        $app->redirect('/producer');

    }

});

# List producers
$app->get('/producer', function () use ($app){
    # list producers
    $producers = Producer::find('all');

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('list-producers.php', array('producers' => $producers, 'success_info' => $success_info));
});


# Producer create campaign
$app->get('/create-campaign', $authenticate($app), function () use ($app){
    $app->render('create-campaign.php');
});


# Producer save campaign
$app->post('/save-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    // handle uploaded file
    $destination = $app->config('configs')['campaign_creative_upload_dir'];

    $upload = new \Wilsonshop\Utils\Upload($destination, 'screen_shot');
    // @TODO check the result message to see if the upload was successful
    $result = $upload->uploadFile("Upload Succeeded","Upload failed");

    $campaign = Campaign::create(
        array('campaign_name'=>$req['campaign_name'], 'budget' => $req['budget'],
            'start_date' => $req['start_date'], 
            'end_date' => $req['end_date'],'copy' => $req['copy'],
            'screen_shot' => $_FILES['screen_shot']['name'],'url' => $req['url'],'platform' => $req['platform']));

    // create a new account with the campaign id
    $email = $app->view()->getData('user');
    $producer = Producer::find_by_email_address($email);

    $account = Account::create(
        array('account_name'=>'test','id_producer'=>$producer->id_producer, 'campaign_id'=>$campaign->campaign_id));

    $to = 'markspeed_718@yahoo.com';
    $subject = 'New campaign posted to Shareitcamp: '.$campaign->title;
    $body = $campaign->copy;
    $from = 'From: info@wilsonshop.biz';
    // @TODO look into using class if headers get more intense
    //$email = new \Wilsonshop\Utils\Email($to,$body,$subject,$from);
    //$result = $email->sendEmail();
    mail($to, $subject, $body, $from);
    $app->flash('success_info', 'Campaign Saved');
    $app->redirect('/campaigns');
});

# List campaign by id
$app->get('/campaigns/:id', $authenticate($app), function ($id) use ($app){
    # list campaigns
    if ($id != null) {
        $campaigns = Campaign::find($id);
    }
    $app->render('list-campaigns.php', array('campaigns' => $campaigns));
});


# List all campaigns
$app->get('/campaigns', $authenticate($app), function () use ($app){

    $email = $app->view()->getData('user');
    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $producer = Producer::find_by_email_address($email);

    # list campaigns
    $query = "SELECT  c.*, (SELECT Count(cr.supporter_id) FROM campaign_responses cr
        WHERE c.campaign_id = cr.campaign_id) as num_supporters
        FROM campaigns c
        LEFT JOIN accounts ac ON ac.campaign_id = c.campaign_id
        WHERE ac.id_producer = ".$producer->id_producer."
        ORDER BY campaign_id DESC";

    // @TODO filter by the producer_id
    $campaigns = Campaign::find_by_sql($query);
    $app->render('list-campaigns.php', array('campaigns' => $campaigns, 'success_info' => $success_info));
});

# approve campaign
$app->get('/campaign-detail', $authenticate($app), function () use ($app){

    # list supporters for a particular campaign
    $id = $app->request()->get('id');

    if (is_null($id)) {
        $app->redirect('/campaigns');
    }

    $campaign_supporters = Campaign_response::find('all',
	 array('conditions' => array('campaign_id in (?)', array($id))));

    $supporter_ids = array();

    foreach ($campaign_supporters as $cs) {
        $supporter_ids[] = $cs->supporter_id;
    }

    if (count($supporter_ids) == 0) {
        $supporters = array();
    }else{
        $supporters = Supporter::find($supporter_ids);
    }

    if (count($supporters) == 1) {
        $supporters = array($supporters);
    }

    $campaign = Campaign::find($id);
    $app->render('campaign-detail.php', array('supporters' => $supporters, 'campaign'=>$campaign));
});


# Approve campaign
$app->post('/approve-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::find($req['campaign_id']);

    $campaign->update_attributes(
        array('approved'=>'Y', 'campaign_id'=>$req['campaign_id']));

    $app->flash('success_info', 'Campaign Approved');

    $app->redirect('/campaigns-performance', array('campaign' => $campaign));
});


# Show campaign performance of approved campaign
$app->get('/campaigns-performance', $authenticate($app), function () use ($app){

    # show campaign
    // @TODO remove hard-coded campaign id
    $campaign = Campaign::find(7);

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('campaign-performance.php', array('campaign' => $campaign, 'success_info' => $success_info));
});

# create-reward
$app->get('/create-reward', $authenticate($app), function () use ($app){

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('create-reward.php', array('success_info' => $success_info));
});

# Producer save campaign
$app->post('/save-reward', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    // handle uploaded file
    $destination = $app->config('configs')['rewards_creative_upload_dir'];

    $upload = new \Wilsonshop\Utils\Upload($destination, 'image');
    // @TODO check the result message to see if the upload was successful
    $result = $upload->uploadFile("Upload Succeeded","Upload failed");

    $reward = Reward::create(
        array('reward_name'=>$req['reward_name'], 'image'=>$_FILES['image']['name'], 'details' => $req['details'],
            'expiration_date' => $req['expiration_date'], 'quantity_remaining' => $req['quantity_remaining'], 
            'point_value' => $req['point_value']));

    $app->flash('success_info', 'Reward Saved');
    $app->redirect('/campaigns');
});
