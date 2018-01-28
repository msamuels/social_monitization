<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

                <H1>Your member campaigns:</H1>

                    <div>
                            <p> Member campaigns</p>

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
                                <?php echo $campaign->campaign_name; ?>
                                <br />

                                <form method="POST" action="/producer/save-include-member-campaign">

                                    <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>">

                                    <input type="hidden" name="member_producer_id" value="<?php echo $campaign->getProducer()->id_producer; ?>">


                                    <button name="pref" class="btn btn-success" type="submit" value="YES">Include</button>
                                    <button name="pref" class="btn btn-success" type="submit" value="NO">Ignore</button>

                                </form>

                            </li>
                    <?php } } ?>

                </ul>

            </div> <!-- end column small-6-->
        </div>

        <div class="col-sm-3"></div>

    </div><!--end container -->
</section><!--end section -->
