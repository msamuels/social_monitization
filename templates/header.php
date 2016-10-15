<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>shareitcamp</title>
    <meta name="description" content=" Support. This Simple Investment Makes A Big Difference. Shareticamp is a community of passionate individuals who lend their support for projects and causes by sharing them with their networks (social and otherwise). Join shareitcamp and see what a difference your support can make. ">
    <meta name="author" content="shareitcamp.com">

    <!-- Google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
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


<?php require_once('navigation.php'); ?>
