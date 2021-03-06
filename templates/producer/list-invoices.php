<section class="section" id="features">
    <div class="container">

        <H1>Invoices</H1>
        <div class="row" id="supporters-list">

            <div class="col-sm-2"></div>

            <div class="col-sm-8">

                <ul class="list-things" style="list-style: none">
                    <?php
                    if (count($campaigns) > 0) {
                        foreach ($campaigns as $campaign) {
                            ?>
                            <li class="list-item">
                                <p><strong>
                                        <a href="/producer/invoice/<?php echo $campaign->campaign_id; ?>">
                                            <?php echo $campaign->campaign_name; ?>
                                        </a>
                                    </strong></p>
                                <p>
                                <p class="by-line"><i> by <?php echo $campaign->getProducer()->org_name; ?></i></p>
                                <p>
                                <p>
                                    <a href="/producer/invoice/<?php echo $campaign->campaign_id; ?>">
                                        <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>"
                                             height="200"/>
                                    </a>
                                </p>
                                <p class="list-campaign-copy"><?php echo substr($campaign->copy, 0, 50); ?>
                                    ...<a style="text-decoration: underline"
                                          href="/producer/invoice/<?php echo $campaign->campaign_id; ?>">Learn More</a>
                                </p>

                            </li>
                            <?php
                        }
                    }
                    ?>

                </ul>
            </div>

            <div class="col-sm-2"></div>

        </div>

    </div><!--end container -->
</section><!--end section -->