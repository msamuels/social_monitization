<div class="row"> 
	<!--<div class="col-xs-6 col-md-6">image off to the left</div>-->
	<div class="col-xs-6 col-md-12">

	<H2>Welcome </H2>

	<?php if(!empty($email_error)){ ?>
	    <div class="alert alert-danger"><?php echo $email_error; ?></div>
	<?php } ?>

	<?php if(!empty($password_error)){ ?>
	    <div class="alert alert-danger"><?php echo $password_error; ?></div>
	<?php } ?>

	<?php if(!empty($error)){ ?>
	    <div class="alert alert-danger"><?php echo $error; ?></div>
	<?php } ?>

<form action="/login" method="POST">

    <label>Account Type:</label>

    <select name="user_type">
        <option value="supporter">Supporter</option>
        <option value="producer">Producer</option>
    </select>
    <br />

    <label>Username:</label> 
    <input type="text" name="email" />
    <br />

    <label>Password:</label> 
    <input type="text" name="password" />
    <br />

    <button class="btn btn-primary" type="submit" >Submit</button>

</form>
</div>
</div>

<div class="row"> 
	<div class="col-xs-6 col-md-12" style="border: 1px solid grey; margin: 5px;">
		Join our mailing list <input type="text">
	</div>
</div>

<div class="row" id="how-it-works">
	<p><H2>How it works</H2></p>
	<div class="col-xs-4 col-sm-3 pull-left" class="how-it-works-steps">
		<div class="circle pull-left"><span>1</span></div>
		<div class="pull-left">Create an account</div>
	</div>
	<div class="col-xs-4 col-sm-3 pull-left" class="how-it-works-steps">
		<div class="circle pull-left"><span>2</span></div>
		<div class="pull-left">Create Campaign</div>
	</div>


	<div class="col-xs-4 col-sm-3" class="how-it-works-steps">
		<div class="circle pull-left"><span>3</span></div>
		<div class="pull-left">Supporters spread the word</div>
	</div>
</div>

<div class="row"> 
	<div class="col-xs-6 col-md-12">Easy Setup and Free</div>
</div>

<H2>Campaigns</H2>

<div class="row" style="margin-bottom: 15px; "> 
	<div class="col-xs-6 col-md-4">
		<p><img src=images/screenshots/"<?php echo $campaigns[0]->screen_shot; ?>" height="100" width="100" /></p>
		<p><?php echo $campaigns[0]->campaign_name; ?></p>
		<button class="btn btn-primary">Support</button>
	</div>
	<div class="col-xs-6 col-md-4">
		<p><img src="images/screenshots/<?php echo $campaigns[1]->screen_shot; ?>" height="100" width="100" /></p>
		<p><?php echo $campaigns[1]->campaign_name; ?></p>
		<button class="btn btn-primary">Support</button>
	</div>
	<div class="col-xs-6 col-md-4">
		<p><img src="images/screenshots/<?php echo $campaigns[2]->screen_shot; ?>" height="100" width="100" /></p>
		<p><?php echo $campaigns[2]->campaign_name; ?></p>
		<button class="btn btn-primary">Support</button>
	</div>
</div>

