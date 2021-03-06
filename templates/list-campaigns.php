<H1>Campaigns</H1>

<?php if (isset($success_info)) { ?>
    <div class="alert alert-success"><?php echo $success_info; ?></div>
<?php } ?>

<div class="row" id="supporters-list">

    <div class="col-sm-2"></div>

    <div class="col-sm-8">

    <ul class="list-things">
        <?php
        if (count($campaigns) > 0) {
            foreach ($campaigns as $campaign) {
                ?>
                <li class="list-item">
                    <p><a href="/campaign-detail?id=<?php echo $campaign->campaign_id; ?>">
                            <?php echo $campaign->campaign_name; ?>
                        </a>
                    </p>
                    <p class="by-line"><i> by <?php echo $campaigns[0]->getProducer()->org_name; ?></i></p>
                    <p>
                        <a href="/campaign-detail?id=<?php echo $campaign->campaign_id; ?>">
                            <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" height="200"/>
                        </a>
                    </p>
                    <p><?php echo substr($campaign->copy, 0, 50); ?>...</p>
                </li>
                <?php
            }
        }
        ?>

    </ul>
</div>

    <div class="col-sm-2"></div>

    </div>