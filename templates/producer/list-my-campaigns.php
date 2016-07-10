<!-- @TODO remove margin-top -->

<H1>Campaigns</H1>
<div class="row" id="supporters-list" style="margin-left:300px">

    <!-- @TODO remove width -->

    <ul class="list-things" style="list-style: none">
        <?php
        if (count($campaigns) > 0) {
            foreach ($campaigns as $campaign) {
                ?>
                <li class="list-item">
                    <p><strong>
                            <a href="/producer/campaign/<?php echo $campaign->campaign_id; ?>">
                                <?php echo $campaign->campaign_name; ?>
                            </a>
                        </strong></p>
                    <p>
                    <p class="by-line"><i> by <?php echo $campaign->getProducer()->org_name; ?></i></p>
                    <p>
                    <p>
                        <a href="/producer/campaign/<?php echo $campaign->campaign_id; ?>">
                            <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" height="200"/>
                        </a>
                    </p>
                    <p class="list-campaign-copy"><?php echo substr($campaign->copy, 0, 50); ?>...</p>

                </li>
                <?php
            }
        }
        ?>

    </ul>
</div>
