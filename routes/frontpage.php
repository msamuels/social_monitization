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
    $app->get('/home-page', function () use ($app){    
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

    $headers  = 'MIME-Version: 1.0' . "\r\n";    
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    
    
    $headers .= 'From: JA55APL@shareitcamp.com' . "\r\n";   

    // Email JA55APL@shareitcamp.com to let them know we received their RSVP      
        $subject_supporter = "New RSVP from " . $req['rsvpName'];   
        $body_supporter = "<p> RSVP from<br/> Name: " . $req['rsvpName'] ." <br/>Email: " . $req['rsvpEmail'] ." </p><br />  ";  
            
            
                    
    $baseurl =  $destination = $app->config('configs')['base_url'];    
    mail('ja55apl@shareitcamp.com', $subject_supporter, $body_supporter, $headers);

    // Email RSVPer to let them know we received their RSVP
        $subject_supporter = "Your RSVP was received!";    
        
        $body_supporter = "<p> Thank you for your interest in the the Advocacy, Policy and Leadership Workshop. <br/>Unforunately the event is now at capacity. As a result you have been added to the waiting list. We will contact you if space becomes avaialable. </p>

            <p> <strong>Get Notified</strong><br/>
            Get updates on this workshop or other intiatives by singing up as a Supporter on ShareItCamp.com. 
                            
            <p>            Head over to ";          
        $body_supporter .= "<a href='https://www.shareitcamp.com/get-started/supporter/register'>  https://www.shareitcamp.com/get-started/supporter/register </a>";       
        $body_supporter .= "  to create a Supporter account in a few short steps. </p><br />"; 
            
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
        $body_supporter .= "<p><br /> Thanks in advance, <br /> APL Team</p>";              
    $baseurl =  $destination = $app->config('configs')['base_url'];    
    mail($req['rsvpEmail'], $subject_supporter, $body_supporter, $headers);

    $app->flash('success_info', 'Thank You. Please check your email for confirmation.');
    $app->redirect('/producer/Jamaica-55-Advocacy-Policy-and-Leadership-Workshop'); 
});
