<?php

# create-reward
$app->get('/create-reward', $authenticate($app), function () use ($app){

    $flash = $app->view()->getData('flash');

    $campaigns = Campaign::find('all');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('admin/create-reward.php', array('success_info' => $success_info, 'campaigns' => $campaigns));
});

# Save rewards
$app->post('/save-reward', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    // handle uploaded file
    $destination = $app->config('configs')['rewards_creative_upload_dir'];

    $upload = new \Wilsonshop\Utils\Upload($destination, 'image');

    // ensure only allowed filetypes make it in
    $allowed =  array('png' ,'jpg');
    $filename = $upload->file_name;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed) ) {
        $app->flash('success_info', 'Error: Invalid file type');
        $app->redirect('/create-reward');
    }

    $rename_to = strtotime("now") .".".$ext;

    // @TODO check the result message to see if the upload was successful
    $result = $upload->uploadFile("Upload Succeeded","Upload failed", $rename_to);

    $reward = $req['campaign'] == 0 ? NULL : $req['campaign'];

    $reward = Reward::create(
        array('reward_name'=>$req['reward_name'], 'image'=>$rename_to, 'details' => $req['details'],
            'expiration_date' => $req['expiration_date'], 'quantity_remaining' => $req['quantity_remaining'],
            'point_value' => $req['point_value'], 'campaign_id' => $reward,  'description' => $req['description'],
            'type' => $req['type']));

    $msg = 'Reward Saved: '. $req['reward_name'];
    $app->flash('success_info', $msg);
    $app->redirect('/admin-rewards');
});

# List rewards
$app->get('/admin-rewards', $authenticate($app), function () use ($app){

    $rewards = Reward::find('all');

    $flash = $app->view()->getData('flash');

    $success_info = 'Rewards list';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('admin/list-rewards.php', array('rewards' => $rewards, 'success_info' => $success_info));
});

# List all campaigns
$app->get('/admin/campaigns', $authenticate($app), function () use ($app){

    $user_name = $app->view()->getData('user');
    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    # list campaigns
    $query = "SELECT  c.*, (SELECT Count(cr.supporter_id) FROM campaign_responses cr
        WHERE c.campaign_id = cr.campaign_id) as num_supporters
        FROM campaigns c
        LEFT JOIN accounts ac ON ac.campaign_id = c.campaign_id
        ORDER BY campaign_id DESC";

    // @TODO filter by the producer_id
    $campaigns = Campaign::find_by_sql($query);
    $app->render('admin/list-my-campaigns.php', array('campaigns' => $campaigns, 'success_info' => $success_info));
});

# Approve campaign
$app->post('/admin/approve-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::find($req['campaign_id']);

    $campaign->update_attributes(
        array('approved'=>'Y', 'campaign_id'=>$req['campaign_id']));

    // alert producer that campaign is approved
    $producer = $campaign->getProducer();

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: shareitcamp <info@shareitcamp.com>' . "\r\n";

    $subject = $campaign->campaign_name.' has been approved';

    $body = 'Your campaign '.$campaign->campaign_name.' has been approved';

    mail($producer->email_address, $subject, $body, $headers);

    // grab all the supporters to email
    $supporter_email = array();

	// if the campaign is exclusive just find supporters affiliated
	// with the organization the producer is assoicated with.

    if ($campaign->exclusive == 'Y') {
		$org_name = $campaign->getProducer()->org_name;

		$organization = Organization::find_by_name($org_name);
		$affiliation = Organization_affiliation::find_all_by_organization_id($organization->organization_id);

		// extract the ids from the affiliation info we get back.
		$supporter_ids = array();
		foreach ($affiliation as $af) {
		    $supporter_ids[] = $af->supporter_id;
		}

		// check if $supporter_ids is empty
        if(count($supporters) == 0) {
			$app->flash('success_info', 'No supporters affiliated with organization.');

			$app->redirect('/admin/campaigns');
        } else {
		    $supporters = Supporter::find($supporter_ids);
        }

	} else {
        $supporters = Supporter::find('all');
	}


    foreach ($supporters as $supporter) {
        array_push($supporter_email, $supporter->email_address);
    }

    // Email supporter to let them know campaign has been approved by producer
    $headers .= 'BCC: '. implode(",", $supporter_email) . "\r\n";

    $subject_supporter = $campaign->campaign_name;

    $body_supporter = "<p>".$producer->org_name. " is asking for your support for their ".$campaign->campaign_name."
     effort. Click on the link below to find
    out more and, if you are interested, log in to your account and hit the support button. Once you've done that just post to Facebook. </p>";
    $baseurl =  $destination = $app->config('configs')['base_url'];
    $body_supporter .= "<a href='".$baseurl."/supporter/campaign/".$campaign->friendly_url."'>Click here to support</a>";
    $body_supporter .= "<p>Oh, and for sharing the link you will earn 5 points.</p>";
    $body_supporter .= "<p>Thanks, <br />
        The shareitcamp team</p>";

    mail(null, $subject_supporter, $body_supporter, $headers);



    $app->flash('success_info', 'Campaign Approved');

    $app->redirect('/admin/campaigns');
});


# List all supporter
$app->get('/admin/supporters', $authenticate($app), function () use ($app){

    $user_name = $app->view()->getData('user');
    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    # list campaigns
    $supporters = Supporter::find('all');

    $app->render('admin/list-supporters.php', array('supporters' => $supporters, 'success_info' => $success_info));
});

# Update campaign points
$app->post('/update-campaign', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::find($req['campaign_id']);

    $campaign->update_attributes(
        array('points'=>$req['points']));

    $app->flash('success_info', 'Points Updated');

    $app->redirect('/admin/campaigns');
});


# Producer Resend Approved campaign
$app->post('/resend-campaign-notification', $authenticate($app), function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::find($req['campaign_id']);

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

    $subject_supporter = 'Reminder: Please support '.$campaign->campaign_name;

    $producer = $campaign->getProducer();

    $body_supporter = "<p>Just a friendly reminder that ".$producer->org_name. " would like your support in spreading
    the word about their ".$campaign->campaign_name." initiative.
    If you haven't done so Click on the link below to find out more and, if you are interested, log in and click the SHARE button.
    Once you've done that just post to Facebook. </p>";

    $baseurl =  $destination = $app->config('configs')['base_url'];

    $body_supporter .= "<a href='".$baseurl."/supporter/campaign/".$campaign->friendly_url."'>Click here to support</a>";

    $body_supporter .= "<p>If you have shared this initiative once before please share again. Your friends may have
    missed it the first time.</p>";

    $body_supporter .= "<p>Thanks, <br />
        The shareitcamp team</p>";

    mail(null, $subject_supporter, $body_supporter, $headers);


    $app->flash('success_info', 'Campaign has been resent to supporters');

    $app->redirect('/admin/campaigns');
});
