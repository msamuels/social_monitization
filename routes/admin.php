<?php

# create-reward
$app->get('/create-reward', $authenticate($app), function () use ($app){

    $flash = $app->view()->getData('flash');

    $success_info = '';
    if (isset($flash['success_info'])) {
        $success_info = $flash['success_info'];
    }

    $app->render('admin/create-reward.php', array('success_info' => $success_info));
});

# Save rewards
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