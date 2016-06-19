<meta property="og:url"                content="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->campaign_id; ?>" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?php echo $campaign->campaign_name; ?>" />
<meta property="og:description"        content="<?php echo $campaign->copy; ?>" />
<meta property="og:image"              content="<?php echo $base_url; ?>/images/screenshots/<?php echo $campaign->screen_shot; ?>" />
    
<!-- @TODO remove margin-top -->
<div style="margin-top: 200px">
    <!-- Show campaigns supported -->

               <H1> <?php echo $campaign->campaign_name; ?> </H1>

            <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" />

            <?php echo $campaign->copy; ?>

            <?php if($reward){ ?>
                <H2>Rewards: </H2>
                <p><?php echo $reward->reward_name; ?></p>
                <p><img src="/images/rewards/<?php echo $reward->image; ?>" height="100" width="100"/></p>
            <?php } ?>

</div>
