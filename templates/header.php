<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>shareitcamp</title>
    <meta name="description" content="There are some great projects being developed and go undiscovered due to lack of exposure. You can be a part of a team that helps change that. Through shareitcamp you are able to lend your support (via social media) to bring attention to some really innovative projects. Follow us on Facebook or visit our website to find out more.">
    <meta name="author" content="shareitcamp.com">
    <link href="/bootstrap/css/bootstrap.min.css?<?php echo date('s')?>" rel="stylesheet">
    <!-- Animate -->
    <link href="/css/animate.css" rel="stylesheet">

    <!-- Icon-font -->
    <link rel="stylesheet" type="text/css" href="/css/material-design-iconic-font.min.css">

    <!--owl carousel css-->
    <link href="/css/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
    <link href="/css/owl.theme.css" rel="stylesheet" type="text/css" media="screen">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- Color css -->
    <link href="/css/colors/default.css" rel="stylesheet">

    <link href="/css/override.css" rel="stylesheet">

    <link href="/css/jquery-ui.min.css" rel="stylesheet">

    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js?<?php echo date('s')?>"></script>
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

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({ selector:'textarea' });
    </script>
</head>

<body data-spy="scroll" data-target="#navbar-menu">

<?php $configs = parse_ini_file('../config.ini'); ?>

<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: <?php echo $configs['fb_app_id']; ?>,
            xfbml: true,
            version: 'v2.6'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

  <div class="navbar navbar-custom navbar-fixed-top sticky" role="navigation">
      <div class="container">

        <!-- Navbar-header -->
        <div class="navbar-header">
          <!-- Responsive menu button -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="zmdi zmdi-menu"></i>
          </button>

          <!-- LOGO -->
          <a class="navbar-brand logo" href="/">
             <span><img src="/images/shareitcamp-logo.svg"/></span>
          </a>

        </div>
        <!-- end navbar-header -->

        <!-- menu -->
        <div class="navbar-collapse collapse" id="navbar-menu">

          <!-- Navbar left -->
          <ul class="nav navbar-nav nav-custom-left">
                <li><a href="/faqs">faq</a></li>

                <?php if (!isset($_SESSION['user_type'])) { ?>
                    <li><a href="/login">log-in</a></li>
                    <?php if ($path[1] == "") { ?>
                        <li><a href="get-started/supporter/register">get started</a></li>
                    <?php } else { ?>
                        <li><a href="/create-producer">get started</a></li>
                    <?php } ?>
                    <li><a href="/about-us">about us</a></li>
                    <li><a href="/organizations">for organizations</a></li>

                <?php } else { ?>
                    <?php if ($_SESSION['user_type'] == "supporter") { ?>
                        <li><a href="/supporter/campaigns">My Campaigns</a></li>
                        <li><a href="/supporter/campaigns/pending">Support Campaigns</a></li>
                        <li><a href="/rewards">Rewards</a></li>
                    <?php } ?>

                    <?php if ($_SESSION['user_type'] == "producer") { ?>
                        <li><a href="/campaigns">Campaigns</a></li>
                        <li><a href="/create-campaign">Create Campaign</a></li>
                        <li><a href="/invoices">Invoices</a></li>
                        <li><a href="#">Manage Account</a></li>
                    <?php } ?>

                    <?php if ($_SESSION['user_type'] == "admin") { ?>
                        <li><a href="/create-reward">Create Rewards</a></li>
                        <li><a href="/admin-rewards">List Rewards</a></li>
                        <li><a href="/admin/campaigns">Approve Campaigns</a></li>
                        <li><a href="/admin/supporters">Supporters</a></li>
                    <?php } ?>

                    <li><a href="/logout">Logout</a></li>

                <?php } ?>

            </ul>

          <!-- Navbar right -->
          <ul class="nav navbar-nav navbar-right">
            <li>
	<?php if (!isset($_SESSION['user_type'])) { ?>
              <a href="/login">Login</a>
	<?php } else { ?>
	      <a href="/logout">Logout</a>
	<?php } ?>
            </li>
            <li>
              <a href="/get-started/supporter/register" class="btn btn-inverse btn-bordered navbar-btn">Signup</a>
            </li>
          </ul>

        </div>
        <!--/Menu -->
      </div>
      <!-- end container -->
  </div>
  <!-- End navbar-custom -->



