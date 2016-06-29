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
                <p><button class="btn btn-success" type="submit">Support Pledged</button></p>
            </li>
            <?php
        }
    }
    ?>

</ul>

</div>
