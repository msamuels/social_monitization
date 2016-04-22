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
$app->get('/create-campaign', function () use ($app){
    $app->render('create-campaign.php');
});


# Producer save campaign
$app->post('/save-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::create(
        array('campaign_name'=>$req['campaign_name'], 'budget' => $req['budget'],
            'estimate' => $req['estimate'], 'start_date' => $req['start_date'], 
            'end_date' => $req['end_date'],
            'screen_shot' => $req['screen_shot']));

    // create a new account with the campaign id
    $email = $app->view()->getData('user');
    $producer = Producer::find_by_email_address($email);

    $account = Account::create(
        array('account_name'=>'test','id_producer'=>$producer->id_producer, 'campaign_id'=>$campaign->campaign_id));

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

    $supporters = Supporter::find($supporter_ids);


    if (count($supporters) == 1) {
        $supporters = array($supporters);
    }

    $campaign = Campaign::find($id);
    $app->render('campaign-detail.php', array('supporters' => $supporters, 'campaign'=>$campaign));
});


# Approve campaign
$app->put('/approve-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->put();

    $campaign = Campaign::update(
        array('campaign_id'=>$req['campaign_id'], 'approved'=>'Y'));

    $app->redirect('/campaigns-performance', array('campaign' => $campaign));
});


# Show campaign performance of approved campaign
$app->get('/campaigns-performance', $authenticate($app), function () use ($app){

    # show campaign
    $campaigns = Campaign::find('all');

    $app->render('campaign-performance.php', array('campaigns' => $campaigns));
});