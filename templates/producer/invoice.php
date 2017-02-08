<section class="section" id="features">
    <div class="container">

        <H1> Invoice: </H1>

        <H3><?php echo $campaign->campaign_name; ?></H3>

        <div class="row sharepoints">
            <div class="col-sm-6">
                <p class="sharepoints-p"> 1. Share This</p>
                <div class="row">
                    <div class="col-sm-3 sharebuttongap">
                        <span class="fb-share-button" style="margin-bottom: 5px;"
                              data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->friendly_url; ?>"
                              data-layout="button_count" data-mobile-iframe="true">
                        </span>
                    </div>

                    <div class="col-sm-3 sharebuttongap">
                        <span><a href="https://twitter.com/share" class="twitter-share-button"
                                 data-via="shareitcamp"
                                 data-show-count="false">Tweet</a>
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </span>
                    </div>

                </div>

            </div>



        <p><img width="300" height="500" style="max-height: 450px;" src="/images/screenshots/<?php echo $campaign->screen_shot; ?>"/></p>

        <H3>Supporters: </H3>

        <div class="row" id="supporters-list" style="margin-left:300px">
            <ul style="list-style: none">
                <?php
                if (count($supporters) > 0) {
                    foreach ($supporters as $supporter) {

                        ?>
                        <li style="border: 1px solid  #0f0f0f; margin-right: 2px; width:170px; float: left">
                            <?php echo $supporter->user_name; ?><br/>
                            Followers: <?php echo $supporter->id_follower_count; ?>
                        </li>

                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <div class="row">

            <H2>Details</H2>
            <label>Duration:</label> <?php echo date_format($campaign->start_date, 'F d, Y '); ?> -
            <?php echo date_format($campaign->end_date, 'F d, Y '); ?>

            <H2>Impressions:</H2>
            <?php

            $i = 0;
            if (count($supporters) > 0) {
                foreach ($supporters as $supporter) {

                    $i += $supporter->id_follower_count;
                }
            }
            ?>
        </div>
        <label>Estimated:</label> <input type="text" name="estimated_impression" value="<?php echo $i; ?>"/>
        <!--<label>Actual:</label> <input type="text" name="actual_impression" value=""/>-->


        <H2>Cost: </H2>
        <label>Estimated:</label> <input type="text" name="estimated_impression"
                                         value="<?php echo $campaign->budget; ?>"/>
        <!--<label>Actual:</label> <input type="text" name="actual_impression" value=""/>-->

        <!--
        <H2>Final Bill: </H2>
        <input type="text" name="final_cost" value="100000"/>
        -->

        <?php if ($campaign->producer_approved == 'N') { ?>
            <form action="/producer/approve-campaign" method="POST" class="form-horizontal" role="form">

                <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>"/>

                <button class="btn btn-primary" type="submit">Approve</button>
            </form>

            <br/>
            By approving this plan you will be billed the above
            <br/>

        <?php } else { ?>
            <div><br/>
                <button class="btn btn-success">Approved</button>
            </div>
        <?php } ?>

    </div><!--end container -->
</section><!--end section -->
