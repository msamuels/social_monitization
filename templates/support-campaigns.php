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
                            <a href="/supporter/campaign/<?php echo $campaign->campaign_id; ?>">
                                <?php echo $campaign->campaign_name; ?>
                            </a>
                        </strong></p>
                    <p>
                    <p class="by-line"><i> by <?php echo $campaign->getProducer()->org_name; ?></i></p>
                    <p>
                    <p>
                        <a href="/supporter/campaign/<?php echo $campaign->campaign_id; ?>">
                            <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" height="100"
                                 width="100"/>
                        </a>
                    </p>
                    <p class="list-campaign-copy"><?php echo substr($campaign->copy, 0, 50); ?>
                        <a href="/supporter/campaign/<?php echo $campaign->campaign_id; ?>"> Learn More...</a>
                    </p>

                    <form action="/save-campaign-support" method="POST">
                        <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>"/>
                        <input type="hidden" name="supporter_id" value="<?php echo $user_id; ?>"/>
                        <button class="btn support-btns" type="submit">Support Campaign</button>
                    </form>

                </li>
                <?php
            }
        }
        ?>

    </ul>
</div>
