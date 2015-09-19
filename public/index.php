<?php
require '../vendor/autoload.php';
require_once '../vendor/php-activerecord/php-activerecord/ActiveRecord.php';

$configs = parse_ini_file('../config.ini');

$cfg = ActiveRecord\Config::instance();
     $cfg->set_model_directory($configs['model_dir']);
     $cfg->set_connections(array(
         'development' => "mysql://". $configs['mysql_user'] .":". $configs['mysql_password'] ."@". $configs['mysql_host'] ."/".$configs['mysql_dbname']));
     $cfg->set_default_connection('development');


$app = new \Slim\Slim();

$app->setName('Social Monitization');

$app->get('/', function () {
    echo "Hello World";
});
	

$app->get('/get-started', function () {
    echo "Get Started";
});

$app->get('/get-started/supporter/login', function () {
    echo "Get Started";
});

$app->get('/supporter/campaigns', function () {
    echo "Get Started";
});

$app->get('/supporter/campaigns/pending', function () {
    echo "Get Started";
});

$app->get('/supporter/campaigns/supported', function () {
    echo "Get Started";
});

$app->get('/supporter/campaigns/supported/status', function () {
    echo "Get Started";
});


$app->get('/supporter/manage-account', function () {
    echo "Get Started";
});

$app->get('/supporter/manage-account/profile', function () {
    echo "Get Started";
});

$app->get('/supporter/manage-account/payment-options', function () {
    echo "Get Started";
});
$app->run();

