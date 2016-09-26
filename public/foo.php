<?php
require '../vendor/autoload.php';
require_once '../vendor/php-activerecord/php-activerecord/ActiveRecord.php';

$configs = parse_ini_file('../config.ini');

$cfg = ActiveRecord\Config::instance();
$cfg->set_model_directory($configs['model_dir']);
$cfg->set_connections(array(
    'development' => "mysql://". $configs['mysql_user'] .":". $configs['mysql_password'] ."@". $configs['mysql_host'] ."/".$configs['mysql_dbname']));
$cfg->set_default_connection('development');

# create Tito
 $user = Producer::create(array('first_name' => 'Tito', 'last_name' => 'Puentes','org_name'=>'My Company','organization_url'=>'www.yahoo.com','email_address'=>'foo@yahoo.com'));
  
  # read Tito
  #$user = User::find_by_name('Tito');
  
  # update Tito
  #$user->name = 'Tito Jr';
  $user->save();
 
 # delete Tito
 #$user->delete();

