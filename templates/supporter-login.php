<div class="row"> 
	<div class="col-xs-6 col-md-8">COL 1</div>
	<div class="col-xs-6 col-md-4">

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
		Join our mailing list <input type="text"></input>
	</div>
</div>

<div class="row"> 
	<div class="col-xs-6 col-md-12" style="border: 1px solid grey; margin: 5px;">
		<p><H2>How it works</H2></p>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lacinia accumsan tincidunt. Aenean viverra convallis tristique. In venenatis viverra neque, ac eleifend quam rutrum et. Integer sit amet commodo turpis. Donec orci neque, elementum ut lacinia eu, condimentum ut arcu. </p>
	</div>
</div>

<div class="row"> 
	<div class="col-xs-6 col-md-12">Easy Setup and Free</div>
</div>

<H2>Campaigns</H2>
<?php if (count($campaigns) > 0) { ?>
<div class="row" style="margin-bottom: 15px; "> 
	<div class="col-xs-6 col-md-4">
		<p><?php echo $campaigns[0]->campaign_name; ?></p>
		<button class="btn btn-primary">Support</button>
	</div>
	<div class="col-xs-6 col-md-4">
		<p><?php echo $campaigns[1]->campaign_name; ?></p>
		<button class="btn btn-primary">Support</button>
	</div>
	<div class="col-xs-6 col-md-4">
		<p><?php echo $campaigns[2]->campaign_name; ?></p>
		<button class="btn btn-primary">Support</button>
	</div>
</div>
<?php } ?>
