<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:url"                content="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->campaign_id; ?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php echo $campaign->campaign_name; ?>" />
    <meta property="og:description"        content="<?php echo $campaign->copy; ?>" />
    <meta property="og:image"              content="<?php echo $base_url; ?>/images/screenshots/<?php echo $campaign->screen_shot; ?>" />
    <meta property="og:image:width" content="196" />
    <meta property="og:image:height" content="300" />
    <title><?php echo $campaign->campaign_name; ?></title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/override.css" rel="stylesheet">
    <link href="/css/jquery-ui.min.css" rel="stylesheet">
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Test Site code
   <script src="//load.sumome.com/" data-sumo-site-id="903902e8ecca928b627578f56a2123411545d219f683743e0293c3f22d4dbfd5" async="async"></script>
   -->
    <script src="//load.sumome.com/" data-sumo-site-id="63d03119b0f57bd789d47afb992766ce5b861812ec577960e3ccde28c598c6fa" async="async"></script>

</head>

<body>

<?php $configs = parse_ini_file('../config.ini'); ?>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : <?php echo $configs['fb_app_id']; ?>,
            xfbml      : true,
            version    : 'v2.6'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/iliv8-Logo2-PNG.png" /></a>
        </div>
        <div class="navbar-default" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/faqs">faq</a></li>

                <?php if(!isset($_SESSION['user_type'])) { ?>
                    <li><a href="/login">log-in</a></li>
                    <li><a href="/">get started</a></li>
                    <li><a href="/">about us</a></li>
                    <li><a href="/organizations">organizations</a></li>

                <?php } else { ?>
                    <?php if($_SESSION['user_type'] == "supporter") { ?>
                        <li><a href="/supporter/campaigns">My Campaigns</a></li>
                        <li><a href="/supporter/campaigns/pending">Support Campaigns</a></li>
                        <li><a href="/rewards">Rewards</a></li>
                    <?php } ?>

                    <?php if($_SESSION['user_type'] == "producer") { ?>
                        <li><a href="/campaigns">Campaigns</a></li>
                        <li><a href="create-campaign">Create Campaign</a></li>
                        <li><a href="#">Manage Account</a></li>
                    <?php } ?>

                    <?php if($_SESSION['user_type'] == "admin") { ?>
                        <li><a href="/create-reward">Create Rewards</a></li>
                        <li><a href="/admin-rewards">List Rewards</a></li>
                    <?php } ?>

                    <li><a href="/logout">Logout</a></li>

                <?php } ?>

            </ul>
        </div>

    </div>

</nav>

<div class="container-fluid text-center bg-grey">
