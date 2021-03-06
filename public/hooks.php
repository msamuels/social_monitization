<?php

$app->hook('slim.before.dispatch', function () use ($app) {

    $parts = explode('/', $app->request->getPath());

    $base_url = $app->config('configs')['base_url'];

    if ($app->router()->getCurrentRoute()->getPattern() == "/producer-events/:id_producer") {
            // do nothing. mainly dont render the header and footer.
    } else {

        if($parts[1] == "supporter" && $parts[2] == "campaign"){

            if (is_numeric($parts[3])) {
                $campaign = Campaign::find_by_campaign_id($parts[3]);
            } else {
                $campaign = Campaign::find_by_friendly_url($parts[3]);
            }
            $app->render('../templates/facebook_header.php', array('campaign'=>$campaign, 'path' => $parts,
                'base_url' => $base_url));

        } else {
	        $app->render('../templates/header.php', array('path' => $parts));
        }
    }
});
  
$app->hook('slim.after.dispatch', function () use ($app) {
	$app->render('../templates/footer.php');
});
