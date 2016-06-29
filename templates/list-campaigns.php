<H1>Campaigns</H1>

<?php if (isset($success_info)) { ?>
    <div class="alert alert-success"><?php echo $success_info; ?></div>
<?php } ?>

<div class="row" id="supporters-list" style="margin-left:300px">
    <ul class="list-things">
        <?php
        if (count($campaigns) > 0) {
            foreach ($campaigns as $campaign) {
                ?>
                <li>
                    <p><?php echo $campaign->campaign_name; ?></p>
                    <p> By: <?php echo $campaigns[0]->getProducer()->org_name; ?></p>
                    <p><img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" height="100" width="100"/></p>
                    <p><?php echo $campaign->copy; ?> Pts</p>
                </li>
                <?php
            }
        }
        ?>

    </ul>
</div>