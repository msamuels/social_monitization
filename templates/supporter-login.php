<div class="row" id="get-started-banner"> 
    <H2 style="color: white" id="call-out">Get Rewarded for <br />Your Support</H2>
    <p><a href="/get-started/supporter/register" class="btn support-btns">Get Started</a></p>
</div>

	<div class="row"><H1>How it works</H1></div>

<div class="row" id="how-it-works" style="align:center">

	<div class="col-xs-4 col-sm-1 pull-left" class="how-it-works-steps"></div>

	<div class="col-xs-4 col-sm-3 pull-left" class="how-it-works-steps">
		<div><img class="icon" src="images/no1.png" /></div>
		<div class="pull-left">
			<p><H2>Organizations post campaign</H2></p>
			<p class="desc">Producer posts promotional message to shareitcamp and supporters on platform are notified</p>
		</div>
	</div>


	<div class="col-xs-4 col-sm-3" class="how-it-works-steps">
		<div><img class="icon" src="images/no3.png" /></div>
		<div class="pull-left">
			<p><H2>You Share It</H2></p>
			<p class="desc">You share the campaigns you like with your social network</p>
		</div>
	</div>

	<div class="col-xs-4 col-sm-3 pull-left" class="how-it-works-steps">
		<div><img class="icon" src="images/no2.png" /></div>
		<div class="pull-left">
			<p><H2>You Receive Points</H2></p>
			<p class="desc">You receive points that can be redeemed for rewards</p>
		</div>
	</div>

</div>

<div class="row" style="margin-bottom: 15px;clear:both">
	<H1>Campaigns</H1> 
	<div class="col-xs-6 col-md-3">
		<p><?php echo $campaigns[0]->campaign_name; ?></p>
		<p><img src="images/screenshots/<?php echo $campaigns[0]->screen_shot; ?>" /></p>
		<button class="btn support-btns">Support</button>
	</div>
	<div class="col-xs-6 col-md-3">
		<p><?php echo $campaigns[1]->campaign_name; ?></p>
		<p><img src="images/screenshots/<?php echo $campaigns[1]->screen_shot; ?>" /></p>
		<button class="btn support-btns">Support</button>
	</div>
	<div class="col-xs-6 col-md-3">
		<p><?php echo $campaigns[2]->campaign_name; ?></p>
		<p><img src="images/screenshots/<?php echo $campaigns[2]->screen_shot; ?>" /></p>
		<button class="btn support-btns">Support</button>
	</div>
	<div class="col-xs-6 col-md-3">
		<p><?php echo $campaigns[3]->campaign_name; ?></p>
		<p><img src="images/screenshots/<?php echo $campaigns[3]->screen_shot; ?>" /></p>
		<button class="btn support-btns">Support</button>
	</div>
</div>

