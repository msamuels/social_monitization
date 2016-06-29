<!-- @TODO remove margin-top -->
<div class="row" id="supporters-list" style="margin-left:300px">
<!-- Show campaigns supported -->
<H1>Supported Campaigns</H1>

<?php if(isset($success_info)){ ?>
    <div class="alert alert-success"><?php echo $success_info; ?></div>
<?php } ?>

<ul class="list-things">
    <?php
    if (count($supported_campaigns) > 0) {
        foreach ($supported_campaigns as $supported_campaign) {
            ?>
            <li>
                <p><?php echo$supported_campaign->campaign->campaign_name; ?></p>
                <p> By: <?php echo $supported_campaign->campaign->getProducer()->org_name; ?></p>
                <p><img src="/images/screenshots/<?php echo $supported_campaign->campaign->screen_shot; ?>" height="100" width="100"/></p>
                <p><?php echo $supported_campaign->campaign->copy; ?></p>
                <form method="POST" action="/save-post-to-fb">
                    <input type="hidden" name="message" id="messgae" value="<?php echo $supported_campaign->campaign->campaign_name; ?>" />

                    <div class="fb-share-button" data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?>" data-layout="button_count" data-mobile-iframe="true"></div>
                </form>
            </li>
            <?php
        }
    }
    ?>

</ul>

</div>
