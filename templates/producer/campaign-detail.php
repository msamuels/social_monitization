<section class="section" id="features">
    <div class="container">

        <div class="row" style="text-align: left;  background-color: #d9edf7; padding-left: 49px">
            <!-- Show campaigns supported -->

            <H1> <?php echo $campaign->campaign_name; ?> </H1>
            <h3><i>by <?php echo $campaign->getProducer()->org_name; ?></i></h3>

        </div>

        <br/><br/>

        <div class="row">

            <div class="col-sm-4">
                <div class="fb-share-button" style="margin-bottom: 5px;"
                     data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->friendly_url; ?>"
                     data-layout="button_count" data-mobile-iframe="true">
                </div>

                <div><a href="https://twitter.com/share" class="twitter-share-button" data-via="shareitcamp"
                        data-show-count="false">Tweet</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>

                <div><img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" class="campaign_image"/></div>

                <div class="fb-share-button"
                     data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->campaign_id; ?>"
                     data-layout="button_count" data-mobile-iframe="true">
                </div>

            </div>


            <div class="col-sm-4">
                <h2>Description</h2>
                <?php echo $campaign->copy; ?>

                <?php if ($reward) { ?>
                    <H2>Rewards: </H2>
                    <p><?php echo $reward->reward_name; ?></p>
                    <p><img src="/images/rewards/<?php echo $reward->image; ?>" height="100" width="100"/></p>
                    <form method="POST" action="/save-post-to-fb">
                        <input type="hidden" name="message" id="messgae"
                               value="<?php echo $supported_campaign->campaign->campaign_name; ?>"/>

                        <div class="fb-share-button"
                             data-href="<?php echo $base_url; ?>
                /supporter/campaign/<?php echo $supported_campaign->campaign->friendly_url; ?>"
                             data-layout="button_count" data-mobile-iframe="true">
                        </div>
                    </form>
                <?php } ?>
            </div>

            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-1">

                    </div>
                    <div class="col-sm-11" style="text-align: left;">
                        <p><strong>Start Date:</strong> <?php echo date_format($campaign->start_date, 'F d, Y '); ?></p>
                        <p><strong>End Date:</strong> <?php echo date_format($campaign->end_date, 'F d, Y '); ?></p>
                        <p><strong>Respond By:</strong> <?php echo date_format($campaign->end_date, 'F d, Y '); ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-1">

                    </div>
                    <div class="col-sm-11" style="text-align: left;">
                        <p><strong>Visit:</strong> <a href="http://<?php echo $campaign->url; ?>" class="highlighted-1"
                                                      target="_blank"><?php echo $campaign->url; ?></a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-1">

                    </div>
                    <div class="col-sm-11" style="text-align: left;">
                        <form action="/update-campaign" enctype="multipart/form-data" method="POST" class="form-horizontal"
                              role="form" id="create-campaign">
                            <div class="form-group">
                                <label class="control-label col-sm-4"><span class="required">* </span>Points: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="points" class="form-control" value="<?php echo $campaign->points; ?>"/>
                                    <input type="hidden" value="<?php echo $campaign->campaign_id; ?>" name="campaign_id" />
                                    <p style="text-align: center">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </p>

                                </div>
                            </div>
                        </form>
                        <p><strong><?php echo $campaign->points; ?> Points</strong></p>
                        <p><strong><?php echo count($supporters); ?></strong> Supporter(s)</p>
                        <p>
                        <ul style="list-style: none">
                            <?php
                            if (count($supporters) > 0) {
                                foreach ($supporters as $supporter) {

                                    ?>
                                    <li style="border-bottom: 1px solid  #0f0f0f;">
                                        <i><?php echo $supporter->user_name; ?></i><br/>
                                        Followers: <?php echo $supporter->id_follower_count; ?>
                                    </li>

                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        </p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-1">

                    </div>

                </div>

            </div>

            <br/>


            <br/>


            <br/>


            <div class="row">
                <div class="col-sm-12" style="border-top:1px solid #ccc; margin-top:10px;">
                    <div class="row"><h2>About <?php echo $producer->org_name; ?></h2></div>
                    <div class="row">
                        <?php echo $producer->description; ?>
                    </div>
                </div>
            </div>

        </div><!--end container -->
</section><!--end section -->
