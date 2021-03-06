<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

                <H1>Your member campaigns:</H1>

                    <div>
                            <p> Select Include to show the campaign on your calendar or Ignore to not do so (no selection is equivalent to Ignore).</p>

                    </div>

                <?php if (isset($success_info) && $success_info != "") { ?>
                    <div class="alert alert-success"><?php echo $success_info; ?></div>
                <?php } ?>


                <ul class="list-things" style="list-style: none">
                    <?php
                        if (count($campaign_details) > 0) {
                            foreach ($campaign_details as $campaign) {
                        ?>
                            <li class="list-item">
                                <strong><?php echo $campaign->campaign_name; ?></strong>
                                <br />
                                <strong>Organization:</strong> <?php echo $campaign->getProducer()->org_name; ?>
                                <br />

                                <p>
                                    <a href="/producer/campaign/<?php echo $campaign->campaign_id; ?>">
                                        <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>"
                                             height="200" width="200"/>
                                    </a>
                                </p>

                                <form method="POST" action="/producer/save-include-member-campaign">

                                    <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>">

                                    <input type="hidden" name="member_producer_id" value="<?php echo $campaign->getProducer()->id_producer; ?>">


                                    <button name="pref" class="btn btn-success" type="submit" value="YES">Include</button>
                                    <button name="pref" class="btn btn-danger" type="submit" value="NO">Ignore</button>

                                </form>

                                <p>Preference: <?php echo $campaign->isIncludeIgnore($producer->id_producer); ?></p>

                            </li>
                    <?php } } ?>

                </ul>

            </div> <!-- end column small-6-->
        </div>

        <div class="col-sm-3"></div>

    </div><!--end container -->
</section><!--end section -->
