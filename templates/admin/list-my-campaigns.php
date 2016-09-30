<section class="section" id="features">
    <div class="container">

        <H1>Campaigns</H1>

        <?php if (isset($success_info)) { ?>
            <div class="alert alert-success"><?php echo $success_info; ?></div>
        <?php } ?>

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
                                    <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" height="200"
                                         width="200"/>
                                </a>
                            </p>
                            <p class="list-campaign-copy"><?php echo substr($campaign->copy, 0, 50); ?>
                                ...<a style="text-decoration: underline"
                                      href="/producer/campaign/<?php echo $campaign->campaign_id; ?>">Learn More</a>
                            </p>

                            <p>
                                <?php if ($campaign->approved != 'Y'){ ?>

                            <form action="/admin/approve-campaign" method="POST" class="form-horizontal" role="form">

                                <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>"/>

                                <button class="btn btn-primary" type="submit">Approve</button>
                            </form>

                            <?php } else { ?>

                                <button class="btn btn-success" type="submit">Approved</button>

                            <?php } ?>
                            </p>

                        </li>
                        <?php
                    }
                }
                ?>

            </ul>
        </div>

    </div><!--end container -->
</section><!--end section -->
