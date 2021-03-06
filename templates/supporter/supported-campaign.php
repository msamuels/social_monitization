<?php if($user_id == '') { ?>

	<script>
		// show the sharing lnks when user clicks share
		$(document).ready(function() {
		    $("#share-it").fancybox();
		});
	</script>


<?php } else { ?>

	<script>
		// show the sharing lnks when user clicks share
		$(document).ready(function() {
		    $("#share-it").fancybox({
		        afterShow: function(){
		            save_campaign();
		        }
		    });
		});

	function save_campaign(){
		$.post("/save-campaign-support", 
		    {campaign_id: <?php echo $campaign->campaign_id; ?>, supporter_id: <?php echo $user_id; ?>}
		);
	}
	</script>

<?php  } ?>


<section class="section" id="features">
    <div class="container">
        <?php if (isset($success_info)) { ?>
            <div class="row alert alert-success"><?php echo $success_info; ?></div>
        <?php } ?>

        <div class="row" style="text-align: left; margin-bottom:20px; padding-left: 15px;">
            <!-- Show campaigns supported -->

            <H1> <?php echo $campaign->campaign_name; ?> </H1>
            <h4><p class="by-line"><i>by <?php echo $campaign->getProducer()->org_name; ?></i></p></h4>

            <div>
                <button class="btn support-btns" id="share-it" href="#share-buttons">
					Share 
				</button>
            </div>
            <div class="row sharepoints" id="share-buttons" style="display:none">
                <div class="col-sm-12">
                    <p class="sharepoints-p"> 
						<?php if($user_id == '') { ?>
							Share
						<?php } else { ?>
							Share This
						<?php } ?>
					</p>

                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                         <div class="addthis_inline_share_toolbox"></div>

                    <div class="row">

                    <!-- REMOVE OLD SHARE BUTTONS
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


                              <div class="col-sm-3 sharebuttongap">
                                <span>
                                    <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                                    <script type="IN/Share" data-counter="right"></script>

                                </span>
                            </div>

                    -->
                          
                


                            <div class="col-sm-12">

                              <hr>
                              

                                <p style="text-align: center;"> You must be logged in to receive points </p>

                            </div>
                            <div class="col-sm-12">
                                 <p style="text-align: center;">
                                        <a href="/login">Log In</a> 
                                        | 
                                        <a href="/get-started/supporter/register">Sign Up</a> 
                                </p>
                            </div>



                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-sm-8">

                <?php if(isset($campaign->youtube_embed)){ ?>
                    <div>
                        <?php echo $campaign->youtube_embed; ?>
                    </div>
                <?php } ?>

                <div>
                    <a id="single_image" href="/images/screenshots/<?php echo $campaign->screen_shot; ?>">
                        <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" class="campaign_image"/>
                    </a>
                </div>
                
               <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox" style="margin-top: 1em;"></div>

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
                        <p><strong>Visit:</strong> <a href="<?php echo $campaign->url; ?>" class="highlighted-1" 
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
                            <p>
                                  <a href="/login"> you must be logged in to receive points</a>
                                </p>

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
