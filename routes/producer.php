<?php

/**
 * function, receives string, returns seo friendly version for that strings,
 *     sample: 'Hotels in Buenos Aires' => 'hotels-in-buenos-aires'
 *    - converts all alpha chars to lowercase
 *    - converts any char that is not digit, letter or - into - symbols into "-"
 *    - not allow two "-" chars continued, convert them into only one syngle "-"
 */
function friendly_seo_string($vp_string)
{

    $vp_string = trim($vp_string);

    $vp_string = html_entity_decode($vp_string);

    $vp_string = strip_tags($vp_string);

    $vp_string = strtolower($vp_string);

    $vp_string = preg_replace('~[^ a-z0-9_.]~', ' ', $vp_string);

    $vp_string = preg_replace('~ ~', '-', $vp_string);

    $vp_string = preg_replace('~-+~', '-', $vp_string);

    return $vp_string;
}

# Create producers
$app->get('/producer/create-producer', function () use ($app){

    $path = explode('/', $app->request->getPath());

    $success_info = NULL;
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('create-producers.php', array('path' => $path, 'success_info' => $success_info));
});

# Save producers
$app->post('/save-producer', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

       $req = $app->request->post();

       // check for duplicate email in system
       $producer_record = Producer::find_by_email_address($req['email_address']);

       if ($producer_record != NULL) {

           $app->flash('success_info', 'Producer email already exists');

           $app->redirect('/create-producer');
       }
 
       $password = password_hash($req['password'], PASSWORD_DEFAULT);

       $producer = Producer::create(
           array('first_name' => $req['first_name'], 'last_name' => $req['last_name'], 'user_name' => $req['user_name'],
		'password' => $password, 'org_name'=>$req['org_name'],'organization_url'=>$req['organization_url'],
               'email_address'=>$req['email_address'], 'description'=>$req['description'], 'country'=>$req['country'],
               'friendly_url'=>friendly_seo_string($req['org_name'])));

        // Auto respond to to producer
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: info@shareitcamp.com' . "\r\n";

        $to = $req['email_address'];
        $subject = 'Welcome to shareitcamp';
        $body = "<p>Thank you for joining shareitacamp. We hope that by working with us, you are able to achieve your
            objectives. If you are ready to get started simply click the link below to set up your first campaign.</p>";

        $body .= "<button>Get Started</button>";

        $body .= "<p>If not you can always log-in to SIC at any time to get started. </p>";

        $body .= "Thanks, <br />The shareitcamp team";

        mail($to, $subject, $body, $headers);


        $app->flash('success_info', 'Producer Saved');

        $app->redirect('/create-campaign');

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
    $app->render('/producer/create-campaign.php');
});


# Producer save campaign
$app->post('/save-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    // handle uploaded file
    $destination = $app->config('configs')['campaign_creative_upload_dir'];

    $upload = new \Wilsonshop\Utils\Upload($destination, 'screen_shot');

    // ensure only allowed filetypes make it in
    $allowed =  array('png', 'PNG' ,'jpg', 'JPG');
    $filename = $upload->file_name;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed) ) {
        $app->flash('success_info', 'Error: Invalid file type');
        $app->redirect('/campaigns');
    }

    $rename_to = strtotime("now") .".".$ext;

    // @TODO check the result message to see if the upload was successful
    $result = $upload->uploadFile("Upload Succeeded","Upload failed", $rename_to);

    $order_number = $randnum = rand(1111111111,9999999999);

    $friendly_url = friendly_seo_string($req['campaign_name']);

    $campaign = Campaign::create(
        array('campaign_name'=>$req['campaign_name'], 'budget' => $req['budget'],
            'start_date' => $req['start_date'],
            'end_date' => $req['end_date'],'copy' => $req['copy'],
            'screen_shot' => $rename_to,'url' => $req['url'],'platform' => $req['platform'],
            'order_number'=>$order_number, 'friendly_url' => $friendly_url, 'youtube_embed' => $req['youtube_embed']));

    // create a new account with the campaign id
    $user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);

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
    $headers .= 'From: info@shareitcamp.com' . "\r\n";
    
    // Email Producer that campaign has been created
    $to = $producer->email_address;
    $subject = 'Confirmation of your order!';

    $body = "<p>Congratulations, your campaign - ".$campaign->campaign_name." - has been successfully uploaded. We will get back to
        you with any questions in 24 hrs. Once approved, supporters on the shareticamp will be notified of your campaign
         and will be able to share it with their social networks. </p><br /><br />";

    $body .= "<p>Please log-in to shareitacamp in 24hrs to view the approval status of your campaign. </p><br />";

    $body .= "<p>Order Summary<br />
        Order #: ".$campaign->order_number."<br />
        Date Posted: ".date("m/d/Y")."<br />
        Campaign Name: ".$campaign->campaign_name."<br />
        Start Date:  ".date_format($campaign->start_date, 'Y-m-d ')."<br />
        End Date:  ".date_format($campaign->end_date, 'Y-m-d ')."<br />
        </p><br /><br />";

    $body .= "<p>Thanks, <br />
        The shareitcamp team</p>";

    mail($to, $subject, $body, $headers);

    // Alert admin that campaign is posted
    mail('samuelsmarlon@yahoo.com', 'Admin: New campaign posted to shareitcamp', $body, $headers);

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

    $user_name = $app->view()->getData('user');
    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $producer = Producer::find_by_user_name($user_name);

    # list campaigns
    $query = "SELECT  c.*, (SELECT Count(cr.supporter_id) FROM campaign_responses cr
        WHERE c.campaign_id = cr.campaign_id) as num_supporters
        FROM campaigns c
        LEFT JOIN accounts ac ON ac.campaign_id = c.campaign_id
        WHERE ac.id_producer = ".$producer->id_producer."
        ORDER BY campaign_id DESC";

    // @TODO filter by the producer_id
    $campaigns = Campaign::find_by_sql($query);
    $app->render('producer/list-my-campaigns.php', array('campaigns' => $campaigns, 'success_info' => $success_info));
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

# show  campaign individually

$app->get('/producer/campaign/:id', $authenticate($app), function ($id) use($app) {

    $base_url = $app->config('configs')['base_url'];

    $campaign = Campaign::find_by_campaign_id($id);

    // @TODO move this to a central function
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


    $reward = Reward::find_by_campaign_id($campaign->campaign_id);

    $producer = $campaign->getProducer();

    $app->render('producer/campaign-detail.php', array('campaign' => $campaign, 'base_url' => $base_url,
        'reward' => $reward, 'producer' => $producer, 'supporters' => $supporters));
});

$app->get('/invoices', $authenticate($app), function () use($app) {

    $base_url = $app->config('configs')['base_url'];

    $user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);

    # list campaigns
    $query = "SELECT  c.*, (SELECT Count(cr.supporter_id) FROM campaign_responses cr
        WHERE c.campaign_id = cr.campaign_id) as num_supporters
        FROM campaigns c
        LEFT JOIN accounts ac ON ac.campaign_id = c.campaign_id
        WHERE ac.id_producer = ".$producer->id_producer."
        ORDER BY campaign_id DESC";

    // @TODO filter by the producer_id
    $campaigns = Campaign::find_by_sql($query);

    //$reward = Reward::find_by_campaign_id($campaign->campaign_id);

    $app->render('producer/list-invoices.php', array('campaigns' => $campaigns, 'base_url' => $base_url,
        'producer' => $producer,));
});

$app->get('/producer/invoice/:id', $authenticate($app), function ($id) use($app) {

    $base_url = $app->config('configs')['base_url'];

    $campaign = Campaign::find_by_campaign_id($id);

    $reward = Reward::find_by_campaign_id($campaign->campaign_id);

    $producer = $campaign->getProducer();

    if (is_null($id)) {
        $app->redirect('/invoices');
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

    $app->render('producer/invoice.php', array('campaign' => $campaign, 'base_url' => $base_url,
        'reward' => $reward, 'producer' => $producer, 'supporters' => $supporters));
});


# Producer Approve campaign
$app->post('/producer/approve-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::find($req['campaign_id']);

    $campaign->update_attributes(
        array('producer_approved'=>'Y', 'campaign_id'=>$req['campaign_id']));


    // grab all the supporters to email
    $supporter_email = array();
    $supporters = Supporter::find('all');

    foreach ($supporters as $supporter) {
        array_push($supporter_email, $supporter->email_address);
    }

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: info@shareitcamp.com' . "\r\n";

    // Email supporter to let them know campaign has been approved by producer
    $headers .= 'BCC: '. implode(",", $supporter_email) . "\r\n";

    $subject_supporter = 'New campaign posted to shareitcamp! ';

    $producer = $campaign->getProducer();

    $body_supporter = "<p>".$producer->org_name. " is asking for your support for their ".$campaign->campaign_name." effort. Click on the link below to find
    out more and, if you are interested, hit the support button. Once you've done that just post to Facebook. </p>";

    $baseurl =  $destination = $app->config('configs')['base_url'];

    $body_supporter .= "<a href='".$baseurl."/supporter/campaign/".$campaign->friendly_url."'>Click here to support</a>";

    $body_supporter .= "<p>Oh, and for sharing the link you will earn 5 points.</p>";

    $body_supporter .= "<p>Thanks, <br />
        The shareitcamp team</p>";

    mail(null, $subject_supporter, $body_supporter, $headers);


    $app->flash('success_info', 'Campaign Approved');

    $app->redirect('/campaigns');
});


// producer page
$app->get('/producer/:name', function ($name) use ($app){

    //find the prducer by name
    $producer = Producer::find_by_friendly_url($name);

    // if no producer found then route might just actual page
    if(is_null($producer)){
        $app->redirect('/'.$name);
    }

    // get the campaigns for this producer
    $options = array('conditions' => array("id_producer = $producer->id_producer"));
    $producer_campaigns = Account::all($options);

    // loop
    $campaign_ids = array();
    foreach ($producer_campaigns as $pc) {
        $campaign_ids[] = $pc->campaign_id;
    }

    // find campaigns for that producer
    $options_2 = array('order' => 'campaign_id desc', 'conditions' => array("approved = 'Y' AND campaign_id in (?)", $campaign_ids));
    $campaigns = Campaign::all($options_2);

    $app->render('frontpage/producer-campaigns.php', array('campaigns'=>$campaigns, 'producer'=>$producer));
});

// invite supporters
$app->get('/account', $authenticate($app), function () use ($app){    
    $path = explode('/', $app->request->getPath());    
    $success_info = NULL;    
        if (isset($flash['success_info'])) {        
            $success_info = $flash['success_info'];    
            }    
            $app->render('producer/account.php', array('path' => $path, 'success_info' => $success_info)); 
});

# Email potential supporters 

	$app->post('/invite-supporters', $authenticate($app), function () use ($app){    

	$req = $app->request->post();    
	
	$email_1 = $req['email_1'];    

	$supporter_email = array($email_1);

	$headers  = 'MIME-Version: 1.0' . "\r\n";    
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    
	
	$headers .= 'From: info@shareitcamp.com' . "\r\n";    
	// Email supporter to let them know campaign has been approved by producer    
		$headers .= 'BCC: '. implode(",", $supporter_email) . "\r\n";    
		$subject_supporter = "Help ".$producer->org_name. " achieve our goals! ";    
		
		$user_name = $app->view()->getData('user');
        $producer = Producer::find_by_user_name($user_name);

		$body_supporter = "<p> Our team at ".$producer->org_name. " ineeds your help in making our upcoming initiatives a success.  Specifically, we need you to spread the word by sharing these initiatives with your social media networks.  </p>        <p>            To make this easy we are partnering with ShareItCamp.com. If you sign up as supporter you be notified each time we post a new initiative (e.g. an event or a project). You can then help us promote the initiative by sharing it on your social channels (e.g. Facebook, Twitter). As an added benefit you gain reward points each time you share.        </p>         <p>            So please head to";          
		$body_supporter .= "<a href='https://www.shareitcamp.com/get-started/supporter/register'>  https://www.shareitcamp.com/get-started/supporter/register </a>";         
		$body_supporter .= "  to lend your support to ".$producer->org_name. " and its efforts. Be sure to indicate ".$producer->org_name. " when signing up.        </p>";        
		$body_supporter .= "<p>Thanks in advance for your continued support, <br /> ".$producer->org_name. " and ShareItCamp</p>";              
	$baseurl =  $destination = $app->config('configs')['base_url'];    
	mail(null, $subject_supporter, $body_supporter, $headers);    
	$app->flash('success_info', 'Email sent');    
	$app->redirect('/campaigns'); 
});
