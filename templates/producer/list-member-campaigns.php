<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

                <H1>Your member campaigns:</H1>

                    <div>
                            <p> Member campaigns</p>

                    </div>

                <?php if (isset($success_info)) { ?>
                    <div class="alert alert-success"><?php echo $success_info; ?></div>
                <?php } ?>


                <ul class="list-things" style="list-style: none">
                    <?php
                        if (count($campaign_details) > 0) {
                            foreach ($campaign_details as $campaign) {
                        ?>
                            <li class="list-item">
                                <?php echo $campaign->campaign_name; ?>
                            </li>
                    <?php } } ?>

                </ul>

            </div> <!-- end column small-6-->
        </div>

        <div class="col-sm-3"></div>

    </div><!--end container -->
</section><!--end section -->
