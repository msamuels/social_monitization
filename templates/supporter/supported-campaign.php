<!-- @TODO remove margin-top -->
<div class="row" style="text-align: left;  background-color: #d9edf7">
    <!-- Show campaigns supported -->

    <H1> <?php echo $campaign->campaign_name; ?> </H1>
    <h3><i>by <?php echo $campaign->getProducer()->org_name; ?></i></h3>

</div>

<br/><br/>

<div class="row">

    <div class="col-sm-4">
        <div class="fb-share-button"
             data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->campaign_id; ?>"
             data-layout="button_count" data-mobile-iframe="true">
        </div>
        <div><img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>"/></div>
        <div class="fb-share-button"
             data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->campaign_id; ?>"
             data-layout="button_count" data-mobile-iframe="true">
        </div>

    </div>


    <div class="col-sm-4">
        <h2>Description</h2>
        <?php echo $campaign->copy; ?>

        <?php if ($reward) { ?>
            <H2>Rewards: </H2>
            <p><?php echo $reward->reward_name; ?></p>
            <p><img src="/images/rewards/<?php echo $reward->image; ?>" height="100" width="100"/></p>
            <form method="POST" action="/save-post-to-fb">
                <input type="hidden" name="message" id="messgae"
                       value="<?php echo $supported_campaign->campaign->campaign_name; ?>"/>

                <divT
                " ass="fb-share-button"
                data-href="<?php echo $base_url; ?>
                /supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?>"
                data-layout="button_count" data-mobile-iframe="true">
            </form>
        <?php } ?>
    </div>

    <div class="col-sm-4">
        <p><strong>Start Date:</strong> <?php echo date_format($campaign->start_date, 'Y-m-d '); ?></p>
        <p><strong>Start Date:</strong> <?php echo date_format($campaign->end_date, 'Y-m-d '); ?></p>
        <p><strong>Respond By:</strong> <?php echo date_format($campaign->end_date, 'Y-m-d '); ?></p>
        <br/>
        <p><strong>Visit:</strong> <?php echo $campaign->url; ?></p>
        <br/>
        <p><strong>Points:</strong> 10</p>
        <br />
        <?php
        if(isset($_SESSION['user_type'])){
            if($isPending){ ?>
                <button class="btn btn-success">Support Pledged</button>
        <?php } else { ?>
            <form action="/save-campaign-support" method="POST">
                <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>"/>
                <input type="hidden" name="supporter_id" value="<?php echo $user_id; ?>"/>
                <button class="btn support-btns" type="submit">Support Campaign</button>
            </form>

        <?php } } ?>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row"><h2>About</h2></div>
            <div class="row">
                <?php echo $producer->description; ?>
            </div>
        </div>
    </div>

</div>
