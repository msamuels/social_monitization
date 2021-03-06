<section class="section" id="features">
    <div class="container">

        <H1>Campaigns</H1>

        <p>Welcome! Take a look at some of our campaigns</p>

        <div class="row" id="supporters-list">

            <div class="col-sm-3">
                <ul>
                    <li><h3>Producers</h3></li>
                <?php foreach($producers as $producer) { ?>
                    <li><a href="/producer/<?php echo $producer->friendly_url; ?>"><?php echo $producer->org_name; ?></a></li>
                <?php } ?>
                </ul>
            </div>

            <div class="col-sm-9">


                    <?php
                    if (count($campaigns) > 0) {
                        foreach ($campaigns as $campaign) {
                            ?>
                            <div class="list-item col-sm-4" style="margin-bottom: 100px;">
                                <p><strong>
                                        <a href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">
                                            <?php echo $campaign->campaign_name; ?>
                                        </a>
                                    </strong></p>
                                <p>
                                <p class="by-line"><i> by <?php echo $campaign->getProducer()->org_name; ?></i></p>
                                <p>
                                <p>
                                    <a href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">
                                        <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>"
                                             height="100"
                                             width="100"/>
                                    </a>
                                </p>
                                <p class="list-campaign-copy"><?php echo substr($campaign->copy, 0, 50); ?>
                                    ...<a style="text-decoration: underline"
                                          href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">Learn
                                        More</a>
                                </p>

                                    <a href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>" class="btn support-btns">Support Campaign</a>

                            </div>
                            <?php
                        }
                    }
                    ?>


            </div>

        </div>

    </div><!--end container -->
</section><!--end section -->
