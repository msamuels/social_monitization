<section class="section" id="features">
    <div class="container">
        <?php if (isset($success_info)) { ?>
            <div class="row alert alert-success"><?php echo $success_info; ?></div>
        <?php } ?>
        <div class="row">
            <div class="col-sm-6">
                <p> 1. Share</p>
                <div class="row">
                    <div class="col-sm-3">
                        <span class="fb-share-button" style="margin-bottom: 5px;"
                              data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->friendly_url; ?>"
                              data-layout="button_count" data-mobile-iframe="true">
                        </span>
                    </div>

                    <div class="col-sm-3">
                        <span><a href="https://twitter.com/share" class="twitter-share-button"
                                 data-via="shareitcamp"
                                 data-show-count="false">Tweet</a>
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </span>
                    </div>

                    <div class="col-sm-6">

                    </div>

                </div>

            </div>

            <div class="col-sm-6">
                <?php  if ($isPending) { ?>
                <p> 2. Registered Supporter? Enter your email address or username to receive reward points</p>

                <form action="/supporter/email-claim-points" method="POST" id="claim">
                    
                    <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>" />
                    <div class="form-group">
                        <label class="control-label col-sm-3">Email/Username: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email-username"
                                   placeholder="Enter email or username"/>

                            Don’t have an account?
                            <a href="/get-started/supporter/register" class="highlighted" style="font-size: medium">Register</a>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>

                </form>
                <?php } ?>
            </div>
        </div>

        <div class="row" style="text-align: left; margin-bottom:20px; padding-left: 15px;">
            <!-- Show campaigns supported -->

            <H1> <?php echo $campaign->campaign_name; ?> </H1>
            <h4><p class="by-line"><i>by <?php echo $campaign->getProducer()->org_name; ?></i></p></h4>

        </div>

        <div class="row">

            <div class="col-sm-8">


                <div>
                    <a id="single_image" href="/images/screenshots/<?php echo $campaign->screen_shot; ?>">
                        <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" class="campaign_image"/>
                    </a>
                </div>

                <div class="fb-share-button"
                     data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $campaign->friendly_url; ?>"
                     data-layout="button_count" data-mobile-iframe="true">
                </div>

            </div>

            <div class="col-sm-4" style="margin-top: 44px; padding-left: 20px;">
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
                        <p><strong><?php echo $campaign->points; ?></strong> Points</p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-1">

                    </div>

                    <div class="col-sm-11" style="text-align: left;">
                        <?php
                        if (isset($_SESSION['user_type'])) {
                            if ($isPending) { ?>
                                <form action="/save-campaign-support" method="POST">
                                    <input type="hidden" name="campaign_id"
                                           value="<?php echo $campaign->campaign_id; ?>"/>
                                    <input type="hidden" name="supporter_id" value="<?php echo $user_id; ?>"/>
                                    <button class="btn support-btns" type="submit">Support Campaign</button>
                                </form>
                            <?php } else { ?>
                                <button class="btn btn-success support-pledged">Support Pledged</button>
                                <?php if ($supportedCampaigns[0]->campaign_response == null) { ?>
                                    <br/><br/><br/>
                                    <p>Link to post: </p>
                                    <form action="/save-campaign-post-link" method="POST">
                                        <input type="text" name="post-link" id="post-link" class="form-control"
                                               placeholder="Please enter the link to your facebook post"/>
                                        <input type="hidden" name="campaign_id"
                                               value="<?php echo $campaign->campaign_id; ?>"/>
                                        <input type="hidden" name="supporter_id" value="<?php echo $user_id; ?>"/>
                                        <button class="btn support-btns" type="submit">Save post link</button>
                                    </form>
                                <?php } else { ?>
                                    <br/><br/><br/>
                                    <p>Post link:</p>
                                    <p><?php echo $supportedCampaigns[0]->campaign_response; ?></p>
                                <?php } ?>
                            <?php }
                        } else { ?>
                            <a href="/login" class="btn btn-primary btn-shadow btn-rounded w-lg animated fadeInDown wow"
                               data-wow-delay=".4s" style="font-size: 12px; width: 260px;">you must be logged in to
                                receive points</a>

                        <?php } ?>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-sm-12" style="border-top:1px solid #ccc; margin-top:60px; text-align:left;">
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
        </div>

    </div> <!-- end container -->
</section>
<!-- END HOME -->

<!-- FEATURES -->
<section class="organiztion-description-section" id="features">
    <div class="container">

        <div class="row">
            <div class="col-sm-12 org-description">
                <div class="row"><h2>About <?php echo $producer->org_name; ?></h2></div>
                <div class="row">
                    <?php echo $producer->description; ?>
                </div>
            </div>
        </div>

    </div> <!-- end container -->
</section>
<!-- END HOME -->