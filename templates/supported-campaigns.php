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
                <p><a href="/supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?>" >
                        <?php echo$supported_campaign->campaign->campaign_name; ?>
                    </a>
                </p>
                <p><i> by <?php echo $supported_campaign->campaign->getProducer()->org_name; ?></i></p>
                <p><img src="/images/screenshots/<?php echo $supported_campaign->campaign->screen_shot; ?>" height="100" width="100"/></p>
                <p class="list-campaign-copy"><?php echo substr($supported_campaign->campaign->copy, 0, 50); ?>...</p>
                <p><button class="btn btn-success" type="submit">Support Pledged</button></p>
                <div class="fb-share-button" data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?>" data-layout="button_count" data-mobile-iframe="true"></div>
            </li>
            <?php
        }
    }
    ?>

</ul>

</div>
