<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social Monitization</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/override.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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

<div class="container-fluid text-center bg-grey">

<div style="clear:both" class="row">
<nav class="navbar navbar-fixed-top" style="clear:both">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><img src="/iliv8-Logo2-PNG.png" /></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/">get started</a></li>
				<li><a href="/">about us</a></li>
				<li><a href="/">faq</a></li>
				<li><a href="/login">log-in</a></li>
				<li><a href="/organizations">organizations</a></li>
			</ul>
		</div>
	</div>

	<?php if(isset($_SESSION['user_type'])) { ?>

		<?php if($_SESSION['user_type'] == "supporter") { ?>

			<nav class="navbar subnav">

				<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/supporter/campaigns">My Campaigns</a></li>
					<li><a href="/supporter/campaigns/pending">Support Campaigns</a></li>
					<li><a href="/rewards">Rewards</a></li>
					<li><a href="/logout">Logout</a></li>
				</ul>
			</div>
		</nav>

		<?php } ?>


		<?php if($_SESSION['user_type'] == "producer") { ?>

			<nav class="navbar subnav">

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/campaigns">Campaigns</a></li>
						<li><a href="create-campaign">Create Campaign</a></li>
						<li><a href="/get-started/supporter/register">Manage Account</a></li>
						<li><a href="/logout">Logout</a></li>
					</ul>
				</div>
			</nav>

		<?php } ?>

	<?php } ?>

</nav>
</div>
