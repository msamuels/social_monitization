<?php
require '../vendor/autoload.php';
require_once '../vendor/php-activerecord/php-activerecord/ActiveRecord.php';

$configs = parse_ini_file('../config.ini');

$cfg = ActiveRecord\Config::instance();
     $cfg->set_model_directory('/var/www/html/social_monitization/models');
     $cfg->set_connections(array(
         'development' => "mysql://". $configs['mysql_user'] .":" .$configs['mysql_password']. "@ .$configs['mysql_host']. "/".$configs['mysql_database']"));
     $cfg->set_default_connection('development');


$app = new \Slim\Slim();

$app->setName('Social Monitization');

$app->get('/', function () {
    echo "Hello World";
});
	
$app->run();

