<?php
require '../vendor/autoload.php';
require_once '../vendor/php-activerecord/php-activerecord/ActiveRecord.php';

session_start();

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

$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'myappsecret')));


require 'hooks.php';

$app->setName('Social Monitization');

#Login Stuff

include "../routes/frontpage.php";

#Login Stuff

include "../routes/auth.php";

#Supporter stuff

include "../routes/supporter.php";


#Producer stuff

include "../routes/producer.php";

$app->run();

