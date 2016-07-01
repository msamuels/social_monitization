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

        // Auto respond to to producer
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: info@wilsonshop.biz' . "\r\n";

        $to = $req['email_address'];
        $subject = 'Welcome to shareitcamp';
        $body = "<p>Thank you for joining shareitacamp. We hope that by working with us, you are able to achieve your
            objectives. If you are ready to get started simply click the link below to set up your first campaign.</p>";

        $body .= "<button>Get Started</button>";

        $body .= "<p>If not you can always log-in to SIC at any time to get started. </p>";

        $body .= "Thanks, <br />The shareitcamp team";

        mail($to, $subject, $body, $headers);


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

    // grab all the supporters to email
    $supporter_email = array();
    $supporters = Supporter::find('all');

    foreach ($supporters as $supporter) {
        array_push($supporter_email, $supporter->email_address);
    }

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: info@wilsonshop.biz' . "\r\n";
    
    // Email Producer that campaign has been created
    $to = $producer->email_address;
    $subject = 'Confirmation of your order!';

    $body = "<p>Congratulations, your campaign - ".$campaign->campaign_name." - has been successfully uploaded. We will get back to
        you with any questions in 24 hrs. Once approved, supporters on the shareticamp will be notified of your campaign
         and will be able to share it with their social networks. </p><br /><br />";

    $body .= "<p>Please log-in to shareitacamp in 24hrs to view the approval status of your campaign. </p><br />";

    $body .= "<p>Order Summary<br />
        Order #: 1234567890<br />
        Date Posted: 02/20/16<br />
        Campaign Name: ".$campaign->campaign_name."<br />
        Start Date:  ".date_format($campaign->start_date, 'Y-m-d ')."<br />
        End Date:  ".date_format($campaign->end_date, 'Y-m-d ')."<br />
        </p><br /><br />";

    $body .= "<p>Thanks, <br />
        The shareitcamp team</p>";

    mail($to, $subject, $body, $headers);



    // Email supporter to let them know campaign has been created
    $to_supporter = implode(',',$supporter_email);
    $subject_supporter = 'New campaign posted to shareitcamp! ';

    $body_supporter = "<p>".$producer->org_name. " is asking for your support for their ".$producer->org_name." effort. Click on the link below to find
    out more and, if you are interested, hit the support button. Once you’ve don’t that just post to Facebook. </p>";

    $body_supporter .= "<button>Click here to support</button>";

    $body_supporter .= "<p>Oh, and for sharing the link you will earn 10 points.</p>";

    $body_supporter .= "<p>Thanks, <br />
        The shareitcamp team</p>";

    mail($to_supporter, $subject_supporter, $body_supporter, $headers);

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

