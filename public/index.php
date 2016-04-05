<?php
require '../vendor/autoload.php';
require_once '../vendor/php-activerecord/php-activerecord/ActiveRecord.php';

$configs = parse_ini_file('../config.ini');

$cfg = ActiveRecord\Config::instance();
     $cfg->set_model_directory($configs['model_dir']);
     $cfg->set_connections(array(
         'development' => "mysql://". $configs['mysql_user'] .":". $configs['mysql_password'] ."@". $configs['mysql_host'] ."/".$configs['mysql_dbname']));
     $cfg->set_default_connection('development');


$app = new \Slim\Slim(array(
    'templates.path' => '../templates/',
    'debug' => true
));

require 'hooks.php';

$app->setName('Social Monitization');

$app->get('/', function () {
    //phpinfo();
    echo "Hello World";
});

$app->get('/get-started', function () {
    echo "Get Started";
});


#Supporter stuff

include "../routes/supporter.php";


#Producer stuff

include "../routes/producer.php";

$app->run();

