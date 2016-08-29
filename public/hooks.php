<?php

$app->hook('slim.before.dispatch', function () use ($app) {

    $parts = explode('/', $app->request->getPath());

    $base_url = $app->config('configs')['base_url'];

    if($parts[1] == "supporter" && $parts[2] == "campaign"){

        $campaign = Campaign::find_by_campaign_id($parts[3]);
        $app->render('../templates/facebook_header.php', array('campaign'=>$campaign, 'path' => $parts,
            'base_url' => $base_url));

    }else {
	    $app->render('../templates/header.php', array('path' => $parts));
    }
});
  
$app->hook('slim.after.dispatch', function () use ($app) {
	$app->render('../templates/footer.php');
});