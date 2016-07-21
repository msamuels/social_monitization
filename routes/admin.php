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

    $rename_to = strtotime("now") .".jpg";

    // @TODO check the result message to see if the upload was successful
    $result = $upload->uploadFile("Upload Succeeded","Upload failed", $rename_to);

    $reward = $req['campaign'] == 0 ? NULL : $req['campaign'];

    $reward = Reward::create(
        array('reward_name'=>$req['reward_name'], 'image'=>$rename_to, 'details' => $req['details'],
            'expiration_date' => $req['expiration_date'], 'quantity_remaining' => $req['quantity_remaining'],
            'point_value' => $req['point_value'], 'campaign_id' => $reward));

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
    $headers .= 'From: info@shareitcamp.com' . "\r\n";

    $subject = $campaign->campaign_name.' has been approved';

    $body = 'Your campaign '.$campaign->campaign_name.' has been approved';

    mail($producer->email_address, $subject, $body, $headers);

    $app->flash('success_info', 'Campaign Approved');

    $app->redirect('/admin/campaigns');
});
