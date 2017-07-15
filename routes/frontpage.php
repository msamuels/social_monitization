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
        
        $body_supporter = "<p> We have received your RSVP for the Advocacy, Policy and Leadership Workshop. If you have any questions please email JA55APL@shareitcamp.com. See you on July 27th.  </p><br /> 

            <p>    <b>Details:</b>
            Date: July 27, 2017</br>
            Time: 2p - 5pm</br>
            Location: Mona School of Business and Management. Kingston, Jamaica. </br>
            </p></br>

            <p>    Help spread the word about this workshop. Here's how:"; 
    
             $body_supporter .= " 
                <ul>
                    <li>Register as a supporter on ShareItCamp.com and you will be notified when Advocacy, Policy and Leadership Workshop announces an update. 
                    </li>
                      <li>You can then easily share workshop info on your social networks (e.g. Facebook, Twitter, LinkedIn, etc) from ShareItCamp. <br/>Please use hashtag #JA55APL when you share.
                    </li>
                </ul>      
            </p>         
            <p>            Head over to ";          
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
        $body_supporter .= "<p><br /> Thanks in advance, <br /> APL Team</p>";              
    $baseurl =  $destination = $app->config('configs')['base_url'];    
    mail($req['rsvpEmail'], $subject_supporter, $body_supporter, $headers);

    $app->flash('success_info', 'Thank You. Please check your email for confirmation.');
    $app->redirect('/producer/Jamaica-55-Advocacy-Policy-and-Leadership-Workshop'); 
});
