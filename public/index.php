<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->setName('Social Monitization');

$app->get('/', function () {
    echo "Hello World";
});
	
$app->run();

