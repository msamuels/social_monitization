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
               'email_address'=>$req['email_address']/*, 'description'=>$req['description'], 'country'=>$req['country']*/));

        $app->redirect('/producer');

    }

});

# List producers
$app->get('/producer', function () use ($app){
    # list producers
    $producers = Producer::find('all');
    $app->render('list-producers.php', array('producers' => $producers));
});


# Producer create campaign
$app->get('/create-campaign', function () use ($app){
    $app->render('create-campaign.php');
});


# Producer save campaign
$app->post('/save-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::create(
        array('campaign_name'=>$req['campaign_name'], 'budget' => $req['budget'], 'billing_approved' => $req['billing_approved'], 
            'estimate' => $req['estimate'], 'start_date' => $req['start_date'], 
            'end_date' => $req['end_date'], 'approved' => $req['approved'], 
            'screen_shot' => $req['screen_shot']));

    // create a new account with the campaign id
    $email = $app->view()->getData('user');
    $producer = Producer::find_by_email_address($email);

    $account = Account::create(
        array('account_name'=>'test','id_producer'=>$producer->id_producer, 'campaign_id'=>$campaign->campaign_id));

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

    # list campaigns
    $query = "SELECT c.*, count(cr.supporter_id) as num_supporters
	FROM campaigns c
	LEFT JOIN campaign_responses cr
	ON c.campaign_id = cr.campaign_id
	GROUP by cr.campaign_id";

    // @TODO filter by the producer_id
    $campaigns = Campaign::find_by_sql($query);
    $app->render('list-campaigns.php', array('campaigns' => $campaigns));
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


