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

    unset($_SESSION["FBRLH_state"]);

    if ($app->request->getMethod() == 'POST') {

       $req = $app->request->post();

       // check for duplicate email in system
       $producer_record = Producer::find_by_email_address($req['email_address']);

       if ($producer_record != NULL) {

           $app->flash('success_info', 'Producer email already exists');

           $app->redirect('/producer/create-producer');
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

        $_SESSION['email'] = $producer->email_address;
        $_SESSION['user_type'] = 'producer';
        $_SESSION['user'] =  $producer->user_name;

        $app->flash('success_info', 'Welcome! Your producer account has been created.');

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

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('/producer/create-campaign.php', array('success_info' => $success_info));
});

# edit campaign
$app->get('/edit-campaign/:id', $authenticate($app), function ($id) use ($app){

    # list campaigns
    if ($id != null) {
        $campaign = Campaign::find($id);
    }

    $app->render('/producer/edit-campaign.php', array('campaign' => $campaign));
});


# Producer save campaign
$app->post('/save-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    // if they are saving for later make note in db
    if(isset($req['save'])) {
        $producer_approved = 'N';
    } else {
        $producer_approved = 'Y';
    }

    // handle uploaded file
    $destination = $app->config('configs')['campaign_creative_upload_dir'];

    $upload = new \Wilsonshop\Utils\Upload($destination, 'screen_shot');

    // ensure only allowed filetypes make it in
    $allowed =  array('png', 'PNG' ,'jpg' ,'jpeg' ,'JPG');
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
            'order_number'=>$order_number, 'friendly_url' => $friendly_url,
            'youtube_embed' => $req['youtube_embed'], 'producer_approved' => $producer_approved));

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


# Producer save campaign
$app->post('/edit-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    // if they are saving for later make note in db
    if(isset($req['save'])) {
        $producer_approved = 'N';
    } else {
        $producer_approved = 'Y';
    }

    // handle uploaded file
    $destination = $app->config('configs')['campaign_creative_upload_dir'];

    $upload = new \Wilsonshop\Utils\Upload($destination, 'screen_shot');

    // ensure only allowed filetypes make it in
    /*$allowed =  array('png', 'PNG' ,'jpg', 'JPG');
    $filename = $upload->file_name;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed) ) {
        $app->flash('success_info', 'Error: Invalid file type');
        $app->redirect('/campaigns');
    }

    $rename_to = strtotime("now") .".".$ext;

    // @TODO check the result message to see if the upload was successful
    $result = $upload->uploadFile("Upload Succeeded","Upload failed", $rename_to);*/

    $order_number = $randnum = rand(1111111111,9999999999);

    $friendly_url = friendly_seo_string($req['campaign_name']);

    $campaign = Campaign::find_by_campaign_id($req['campaign_id']);
    $campaign->update_attributes(
        array('campaign_name'=>$req['campaign_name'], 'budget' => $req['budget'],
            'start_date' => $req['start_date'],
            'end_date' => $req['end_date'],'copy' => $req['copy'],
            'url' => $req['url'],'platform' => $req['platform'],
            'order_number'=>$order_number, 'friendly_url' => $friendly_url,
            'producer_approved' => $producer_approved));

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
        $supporters = Supporter::find(array_unique($supporter_ids));
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

    $flash = $app->view()->getData('flash');

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

    // find member campaigns to include on this producer's calendar
    $filter = array('conditions' => array("parent_producer_id" => $producer->id_producer,
                "include" => "YES"));
    $member_campaigns = Include_member_campaign::all($filter);

    foreach ($member_campaigns as $mc) {
        $campaign_ids[] = $mc->campaign_id;
    }

    $excluded_from_home = $app->config('configs')['excluded_from_home'];

    $options_1 = array('order' => 'campaign_id desc', 'conditions' => array("approved = 'Y' AND campaign_id NOT IN (?) ", $excluded_from_home ));

    // find campaigns for that producer
    $options_2 = array('order' => 'campaign_id desc', 'conditions' => array("approved = 'Y' AND campaign_id in (?)", $campaign_ids));
   
    if(count($campaign_ids) == 0){
        $campaigns = array();
    } else {
        $campaigns = Campaign::all($options_2);
    }

    $success_info = NULL;

        if (isset($flash['success_info'])) {        
            $success_info = $flash['success_info'];    
            }  

    $app->render('frontpage/producer-campaigns.php', array('campaigns'=>$campaigns, 'producer'=>$producer, 'success_info' => $success_info));
});

// invite supporters
$app->get('/account', $authenticate($app), function () use ($app){    

    $flash = $app->view()->getData('flash');

    $path = explode('/', $app->request->getPath());    

	$user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);

    $all_producers = Producer::find('all');

    $success_info = NULL;    

    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('producer/account.php', array('path' => $path,
        'all_producers' => $all_producers, 'success_info' => $success_info)); 
});

# Email potential supporters 

	$app->post('/invite-supporters', $authenticate($app), function () use ($app){    

	$req = $app->request->post();      

	$email_addresses = array();

	// loop through the 10 email fields to see which ones have a value (!= '')
	for($i=1 ; $i < 10; $i++) {
		if($req['email_'.$i] != '') {
			array_push($email_addresses, $req['email_'.$i]);
		}
    }  

	// if no email addresses entered just break out
	if(count($email_addresses) == 0){
		return;
	}

	$supporter_email = $email_addresses;

	$user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);


	$headers  = 'MIME-Version: 1.0' . "\r\n";    
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    
	
	$headers .= 'From: msamuels@shareitcamp.com' . "\r\n";    
	// Email supporter to let them know campaign has been approved by producer    
		$headers .= 'BCC: '. implode(",", $supporter_email) . "\r\n";    
		$subject_supporter = "Help ".$producer->org_name. " achieve their goals! ";    
		
		$body_supporter = "<p>Greetings, </p>

						<p> The team at ".$producer->org_name. " needs your help to make their upcoming initiatives successful . One way you can help is by spreading the word about these initiatives to your social networks.
						</p>       

            <p>    To make this easy (and rewarding - more on this later) ".$producer->org_name. " is partnering with "; 

            $body_supporter .= "  <a href='https://www.shareitcamp.com/'> ShareItCamp.com </a> ";

            $body_supporter .= ". Here's how it works: 
                <ul>
                    <li>When you sign up as a supporter on ShareItCamp.com you will be notified by email when ".$producer->org_name. " posts a new project they'd like shared.  
                    </li>

                      <li>You can then easily share it on your social networks (e.g. Facebook, Twitter) from ShareItCamp.com.
                    </li>

                     <li> For each initiative you share you earn reward points that can be redeemed for items such as Amazon gift cards. 
                    </li>

                </ul>      
            </p>         

            <p>            So head over to ";          
		$body_supporter .= "<a href='https://www.shareitcamp.com/get-started/supporter/register'>  https://www.shareitcamp.com/get-started/supporter/register </a>";       
		$body_supporter .= "  to create a Supporter account in a few short steps. Lend your support to ".$producer->org_name. "  and its efforts. </p><br />"; 
            
            $body_supporter .= "<a href='https://www.shareitcamp.com/get-started/supporter/register' 

                    style='
                background-color:   #FFAC00;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;

            '>  Become a Supporter </a><br />";  

		$body_supporter .= "<p>Thanks in advance, <br /> ".$producer->org_name. " and ShareItCamp.com</p>";              
	$baseurl =  $destination = $app->config('configs')['base_url'];    
	mail(null, $subject_supporter, $body_supporter, $headers);    
	$app->flash('success_info', 'Email sent');    
	$app->redirect('/campaigns'); 
});


$app->get('/producer-events/:id_producer', function ($id_producer) use ($app){

    $flash = $app->view()->getData('flash');

    //find the prducer by name
    $producer = Producer::find_by_id_producer($id_producer);

    // if no producer found then route might just actual page
    if(is_null($producer)){
        $app->redirect('/'.$name);
    }

    // get the campaigns for this producer
    $options = array('conditions' => array("id_producer" => $producer->id_producer));
    $producer_campaigns = Account::all($options);

    // loop
    $campaign_ids = array();
    foreach ($producer_campaigns as $pc) {
        $campaign_ids[] = $pc->campaign_id;
    }

    // find member campaigns to include on this producer's calendar
    $filter = array('conditions' => array("parent_producer_id" => $producer->id_producer,
                "include" => "YES"));
    $member_campaigns = Include_member_campaign::all($filter);

    foreach ($member_campaigns as $mc) {
        $campaign_ids[] = $mc->campaign_id;
    }

    $excluded_from_home = $app->config('configs')['excluded_from_home'];

    $options_1 = array('order' => 'campaign_id desc',
        'conditions' => array("approved = 'Y' AND campaign_id NOT IN (?) ",
            $excluded_from_home ));

    // find campaigns for that producer
    $options_2 = array('order' => 'campaign_id desc',
        'conditions' => array("approved = 'Y' AND campaign_id in (?) ",
            array_unique($campaign_ids)));
   
    if(count($campaign_ids) == 0){
        $campaigns = array();
    } else {
        $campaigns = Campaign::all($options_2);
    }

    $out = array();

    foreach ($campaigns as $campaign) {
        $out[] = array(
            'id' => $campaign->id,
            'title' => $campaign->campaign_name,
            'url' => $campaign->url,
            'class' => 'event-important',
            'start' => strtotime($campaign->start_date) . '000',
            'end' => strtotime($campaign->start_date) . '001'
        );
    }

    echo json_encode(array('success' => 1, 'result' => $out));
    exit();

});

# Show member campaigns so prdocer can select to include them or not
$app->get('/member-campaigns', $authenticate($app), function () use ($app){

	$user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);

	// find all members of this producer
	$options = array('conditions' => array("parent_producer_id = $producer->id_producer"));
	$member_producers = Member_producers::all($options);

	$member_ids = array();

    foreach ($member_producers as $member) {
        $member_ids[] = $member->member_producer_id;
    }

	// find all campaigns from those members
	if (count($member_ids) == 0) {
    	$campaigns = array();
	} else {
        $campaigns = Account::find_all_by_id_producer($member_ids);
	}

	$campaign_ids = array();

	if (count($campaigns) > 0) {

		foreach ($campaigns as $camp) {
		    $campaign_ids[] = $camp->campaign_id;
		}

	}


    if (count($campaign_ids) == 0) {
        $campaign_details = array();
    } else {
		$campaign_details = Campaign::find_all_by_campaign_id($campaign_ids);
	}

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('producer/list-member-campaigns.php', array('campaign_details' => $campaign_details, 'success_info' => $success_info));
});


# Producer Approve campaign
$app->post('/producer/save-include-member-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

	$user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);

	$include_decision = array('campaign_id' => $req['campaign_id'],
        'parent_producer_id' => $producer->id_producer, 'member_producer_id' => $req['member_producer_id'], 'include' => $req['pref']);

    // check if the preference already saved
    $filter = array('conditions' => array("member_producer_id" => $req['member_producer_id'],
                "campaign_id" => $req['campaign_id']));
    $preferences = Include_member_campaign::all($filter);

    if (count($preferences) > 0 ) {
        $app->redirect('/member-campaigns');
    } else {
	    Include_member_campaign::create($include_decision);
    }


    $app->flash('success_info', 'Include Preference saved');

    $app->redirect('/member-campaigns');
});

# Producer become a member of another org
$app->post('/producer/save-membership', $authenticate($app), function () use ($app){

    $req = $app->request->post();

	$user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);

    // check if the preference already saved
    $fields = array("member_producer_id" => $req['member_producer_id'],
                "parent_producer_id" => $producer->id_producer);

    Member_producers::create($fields);

    $app->flash('success_info', 'You can now select campaigns from that
             organization show on your calendar');

    $app->redirect('/account');
});
