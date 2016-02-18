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

$app->get('/get-started/supporter/login', function () {
    echo "Get Started";
});

# Register suppporter
$app->get('/get-started/supporter/register', function() use($app) {
    //TODO only find one suporter by login
    $app->render('create-supporter.php');
});

# Save supporter
$app->post('/save-supporter', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

       // @TODO check if email address already in system before saving
       // @TODO id_follower_count is reference to follower_count table. Save to that instead
       $req = $app->request->post();
       $supporter = Supporter::create(
           array('user_name' => $req['username'], 'password' => $req['password'],'email_address'=>$req['email_address'],
               'interests'=>$req['interests'],'id_follower_count'=>$req['followers_fb'] ,'country'=>$req['country']
          ));

        $app->redirect('/supporters');

    }

});

# List supporters
$app->get('/supporters', function () use ($app){
    # list supporters
    $supporters = Supporter::find('all');
    $app->render('list-supporters.php', array('supporters' => $supporters));
});

$app->get('/supporter/campaigns', function () {
    echo "Supporter Campaigns";
});

# Allow the user to select a campaign to support
# Have this page show both pending and campaigns to approve
$app->get('/supporter/campaigns/pending', function () use ($app){
    # list producers
    $campaigns = Campaign::find('all');
    $app->render('support-campaigns.php', array('campaigns' => $campaigns));
});

$app->post('/save-campaign-support', function () use ($app) {

    if ($app->request->getMethod() == 'POST') {

        // @TODO check if supporter already supporting that campaign
        $req = $app->request->post();
        $campaignSupport = Campaign_response::create(
            array('campaign_id' => $req['campaign_id'], 'supporter_id' => $req['supporter_id']));

        $app->redirect('/supporter/campaigns/pending');

    }
});

# Show all campaigns the supporter supports
$app->get('/supporter/campaigns/supported', function () use($app) {
    # list supported campaigns
    $supportedCampaigns = Campaign_response::find('all');
    $app->render('supported-campaigns.php', array('supported_campaigns' => $supportedCampaigns));
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

# Create producers
$app->get('/create-producer', function () use ($app){
    $app->render('create-producers.php');
});

# Save producers
$app->post('/save-producer', function () use ($app){

    if ($app->request->getMethod() == 'POST') {

       // @TODO check if email address already in system before saving
       $req = $app->request->post();
       $producer = Producer::create(
           array('first_name' => $req['first_name'], 'last_name' => $req['last_name'], 'user_name' => $req['user_name'],
               'org_name'=>$req['org_name'],'organization_url'=>$req['organization_url'],
               'email_address'=>$req['email_address'], 'description'=>$req['description'], 'country'=>$req['country']));

        $app->redirect('/producer');

    }

});

# List producers
$app->get('/producer', function () use ($app){
    # list producers
    $producers = Producer::find('all');
    $app->render('list-producers.php', array('producers' => $producers));
});


# Producer create campaign
$app->get('/create-campaign', function () use ($app){
    $app->render('create-campaign.php');
});


# Producer save campaign
$app->post('/save-campaign', function () use ($app){

    $req = $app->request->post();

    $campaign = Campaign::create(
        array('campaign_name'=>$req['campaign_name'], 'budget' => $req['budget'], 'billing_approved' => $req['billing_approved'], 
            'estimate' => $req['estimate'], 'start_date' => $req['start_date'], 
            'end_date' => $req['end_date'], 'approved' => $req['approved'], 
            'screen_shot' => $req['screen_shot']));

    // create a new account with the campaign id
    // @TODO remove hard-coded producer id
    $account = Account::create(
        array('account_name'=>'test','id_producer'=>1, 'campaign_id'=>$campaign->campaign_id));

    $app->redirect('/campaigns');
});

# List campaigns
$app->get('/campaigns', function () use ($app){
    # list campaigns
    $campaigns = Campaign::find('all');
    $app->render('list-campaigns.php', array('campaigns' => $campaigns));
});

# approve campaign requests
$app->get('/campaign-requests', function () use ($app){
    # list supporters for a particular campaign
    $supporters = Supporter::find('all');

    $campaign = Campaign::find('all');
    $app->render('campaign-requests.php', array('supporters' => $supporters, 'campaign'=>$campaign));
});


$app->run();

