<div class="row" id="get-started-banner">
    <H1 style="color: white" id="call-out">Get Rewarded for <br/>Your Support</H1>
    <p><a href="/get-started/supporter/register" class="btn support-btns">Get Started</a></p>
</div>

<div class="row" id="works"><H1>How it works</H1></div>

<div class="row" id="how-it-works" style="align:center">

    <div class="col-xs-4 col-sm-1 pull-left" class="how-it-works-steps"></div>

    <div class="col-xs-4 col-sm-3 pull-left" class="how-it-works-steps">
        <div><img class="icon" src="images/no1.png"/></div>
        <div class="pull-left">
            <p>
            <H3>Organizations post campaign</H3></p>
            <p class="desc">Producer posts promotional message to shareitcamp and supporters on platform are
                notified</p>
        </div>
    </div>


    <div class="col-xs-4 col-sm-3" class="how-it-works-steps">
        <div><img class="icon" src="images/no2.png"/></div>
        <div class="pull-left">
            <p>
            <H3>You Share It</H3></p>
            <p class="desc">You share the campaigns you like with your social network</p>
        </div>
    </div>

    <div class="col-xs-4 col-sm-3 pull-left" class="how-it-works-steps">
        <div><img class="icon" src="images/no3.png"/></div>
        <div class="pull-left">
            <p>
            <H3>You Receive Points</H3></p>
            <p class="desc">You receive points that can be redeemed for rewards</p>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <H1>Campaigns</H1>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <p><?php echo $campaigns[0]->campaign_name; ?></p>
        <p><img src="images/screenshots/<?php echo $campaigns[0]->screen_shot; ?>"/></p>
        <button class="btn support-btns">Support</button>
    </div>
    <div class="col-md-3">
        <p><?php echo $campaigns[1]->campaign_name; ?></p>
        <p><img src="images/screenshots/<?php echo $campaigns[1]->screen_shot; ?>"/></p>
        <button class="btn support-btns">Support</button>
    </div>
    <div class="col-md-3">
        <p><?php echo $campaigns[2]->campaign_name; ?></p>
        <p><img src="images/screenshots/<?php echo $campaigns[2]->screen_shot; ?>"/></p>
        <button class="btn support-btns">Support</button>
    </div>
    <div class="col-md-3">
        <p><?php echo $campaigns[3]->campaign_name; ?></p>
        <p><img src="images/screenshots/<?php echo $campaigns[3]->screen_shot; ?>"/></p>
        <button class="btn support-btns">Support</button>
    </div>
</div>

