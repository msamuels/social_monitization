<?php

$app->hook('slim.before.dispatch', function () use ($app) {
	$app->render('../templates/header.php');
});
  
$app->hook('slim.after.dispatch', function () use ($app) {
	$app->render('../templates/footer.php');
});
