<?php

# Supporter Login page
$app->get('/', function () use ($app){

    $options = array('limit' => 7,  'order' => 'campaign_id desc', 'conditions' => array("approved = 'Y'"));

    if(isset($app->config('configs')['excluded_from_home'])) {

        $excluded_from_home = $app->config('configs')['excluded_from_home'];

        $options = array('order' => 'campaign_id desc', 'conditions' => array("approved = 'Y'
        AND campaign_id NOT IN (?) ", $excluded_from_home ));
    }

    $campaigns = Campaign::all($options);

    $app->render('frontpage/home-page.php', array('campaigns'=>$campaigns));
});

# Organizations page
$app->get('/organizations', function () use ($app){

    $app->render('frontpage/organizations.php');
});

# About us page
$app->get('/about-us', function () use ($app){

    $app->render('frontpage/about.php');
});

# FAQ page
$app->get('/faqs', function () use ($app){

    $app->render('frontpage/faq.php');
});

# FAQ page
$app->get('/privacy-policy', function () use ($app){

    $app->render('frontpage/privacy-policy.php');
});


# Terms and conditions 
$app->get('/termsandconditions', function () use ($app){     
    // point to the template file that has the code for page    
    $app->render('frontpage/termsandconditions.php'); 
});


// JA55 - RSVP
    $app->get('/account', function () use ($app){    
    $path = explode('/', $app->request->getPath());    
    $success_info = NULL;    
        if (isset($flash['success_info'])) {        
            $success_info = $flash['success_info'];    
            }    
            $app->render('frontpage/home-page.php', array('path' => $path, 'success_info' => $success_info)); 
});


# Email RSVPer
    $app->post('/ja55-rsvp', function () use ($app){    
    $req = $app->request->post();      
    
    $rsvpEmail = $rsvpEmail;
    $user_name = $app->view()->getData('user');
    $producer = Producer::find_by_user_name($user_name);
    $headers  = 'MIME-Version: 1.0' . "\r\n";    
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    
    
    $headers .= 'From: JA55APL@shareitcamp.com' . "\r\n";   

// Email JA55APL@shareitcamp.com to let them know we received their RSVP    
        $headers .= 'BCC: ja55apl@shareitcamp.com "\r\n"';   
        $subject_supporter = "You have a new RSVP" . $req['rsvpName'];   
        $body_supporter = "<p> RSVP from<br> Name: " . $req['rsvpName'] ." Email: " . $req['rsvpEmail'] ." </p><br />  ";  
            
            
                    
    $baseurl =  $destination = $app->config('configs')['base_url'];    
    mail(null, $subject_supporter, $body_supporter, $headers);    
    $app->flash('success_info', 'Email sent');    
   // $app->redirect('/campaigns'); 



    // Email RSVPer to let them know we received their RSVP    
        $headers .= 'BCC: '. $req['rsvpEmail'] . "\r\n";   
        $subject_supporter = "RSVP Received for Workshop!";    
        
        $body_supporter = "<p> Looking forward to seeing you on 27 July 2017  </p><br />        
            <p>    Please help us promote this workshop by sharing the link with your social media networks "; 
            $body_supporter .= "  <a href='https://www.shareitcamp.com/'> ShareItCamp.com </a> ";
             $body_supporter .= ". Here is how it works: 
                <ul>
                    <li>When you sign up as supporter on ShareItCamp.com you will be notified when Advocacy, Policy and Leadership Workshop announces an update. 
                    </li>
                      <li>You can then easily share it on your social networks (e.g. Facebook, Twitter, LinkedIn) from ShareItCamp or saved the image and share to Instagram.
                    </li>
                </ul>      
            </p>         
            <p>            So head over to ";          
        $body_supporter .= "<a href='https://www.shareitcamp.com/get-started/supporter/register'>  https://www.shareitcamp.com/get-started/supporter/register </a>";       
        $body_supporter .= "  to create a Supporter account in a few short steps. Lend your support to Advocacy, Policy and Leadership Workshop and its efforts. </p><br />"; 
            
            $body_supporter .= "<a href='https://www.shareitcamp.com/get-started/supporter/register' 
                    style='
                background-color:   #FFAC00;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            '>  Become a Supporter </a><br />";  
        $body_supporter .= "<p>Thanks in advance, <br /> ShareItCamp.com</p>";              
    $baseurl =  $destination = $app->config('configs')['base_url'];    
    mail(null, $subject_supporter, $body_supporter, $headers);    
    $app->flash('success_info', 'Email sent');    
    //$app->redirect('/campaigns'); 
});