<!-- @TODO remove margin-top -->

<H1>Campaigns</H1>
<div class="row" id="supporters-list" style="margin-left:300px">

    <!-- @TODO remove width -->

    <ul class="list-things" style="list-style: none">
        <?php
        if (count($campaigns) > 0) {
            foreach ($campaigns as $campaign) {
                ?>
                <li>
                    <p><?php echo $campaign->campaign_name; ?></p>
                    <p>
                    <p> By: <?php echo $campaigns[0]->getProducer()->org_name; ?></p>
                    <p>
                    <p><img src="images/rewards/<?php echo $campaign->screen_shot; ?>" height="100" width="100"/></p>
                    <p><?php echo $campaign->copy; ?></p>

                    <form action="/save-campaign-support" method="POST">
                        <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>"/>
                        <input type="hidden" name="supporter_id" value="<?php echo $user_id; ?>"/>
                        <button class="btn btn-primary" type="submit">Support Campaign</button>
                    </form>

                </li>
                <?php
            }
        }
        ?>

    </ul>
</div>
