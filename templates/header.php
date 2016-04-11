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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-default">
	<span><a href="/login">Login</a></span> | <span>Contact Us</span>
	 | <a href="/create-producer">Producer Register </a> |
	 <span><a href="/get-started/supporter/register">Supporter Register</a></span>
</nav>

<?php if(isset($_SESSION['user_type'])) { ?>

	<?php if($_SESSION['user_type'] == "supporter") { ?>

		<nav class="navbar navbar-default" id="supporter-nav">
			<span><a href="/supporters">Supporters</a></span>
			<span><a href="/supporter/campaigns">My Campaigns</a></span>
			<span><a href="/supporter/campaigns/pending">Support Campaigns</a></span>
			<span>Contact Us</span>
                        <span><a href="/logout">Logout</a></span>
		</nav>

	<?php } ?>


	<?php if($_SESSION['user_type'] == "producer") { ?>

		<nav class="navbar navbar-default">
			<span>Company X</span> | 
			<span>FAQ</span> | 
			<span><a href="/campaigns">Campaigns</a></span> | 
			<a href="create-campaign">Create Campaign</a> | 
			<span><a href="/campaign-requests">Campaign Requests</a></span> | 
			<span><a href="/campaign-requests">Manage Account</a></span> | 
			<span><a href="/logout">Logout</a></span>
		</nav>

	<?php } ?>

<?php } ?>

