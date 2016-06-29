<!-- @TODO remove margin-top -->
<div style="margin-top: 200px">
    <!-- Show campaigns supported -->

    <H1> <?php echo $campaign->campaign_name; ?> </H1>
    <h2> By: <?php echo $campaign->getProducer()->org_name; ?></h2>
    <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>"/>

    <?php echo $campaign->copy; ?>

    <?php if ($reward) { ?>
        <H2>Rewards: </H2>
        <p><?php echo $reward->reward_name; ?></p>
        <p><img src="/images/rewards/<?php echo $reward->image; ?>" height="100" width="100"/></p>
        <form method="POST" action="/save-post-to-fb">
            <input type="hidden" name="message" id="messgae"
                   value="<?php echo $supported_campaign->campaign->campaign_name; ?>"/>

            <divT" ass="fb-share-button"
                 data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?>"
                 data-layout="button_count" data-mobile-iframe="true"></div>
        </form>
    <?php } ?>

</div>
