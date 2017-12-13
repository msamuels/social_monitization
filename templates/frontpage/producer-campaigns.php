<section class="section" id="features">
    <div class="container">

        <H1>Calendar | <?php echo $producer->org_name; ?></H1>

        <?php if (isset($success_info)) { ?>
            <div class="alert alert-success"><?php echo $success_info; ?></div>
        <?php } ?>

        <div class="row" id="supporters-list">

            <div class="col-sm-6">
            <div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev">&lt;&lt; Prev</button>
				<button class="btn" data-calendar-nav="today">Today</button>
				<button class="btn btn-primary" data-calendar-nav="next">Next &gt;&gt;</button>
			</div>
                <div id="calendar"></div>
                <div><br />
                    <strong>RSVP Key:</strong> <br />
                    Yes – you will receive an email reminder of the event<br />
                    No – you will not receive any reminder<br />
                    Maybe – You will receive a reminder but event will not count on your attendance<br />
                    MyCamp Rewards Icon – Chance for immediate reward for sharing/attending<br />
                </div>

            </div>

            <!-- Boostrap calendar -->
            <script type="text/javascript" src="/js/underscore-min.js"></script>
            <script type="text/javascript" src="/bootstrap-calendar/js/calendar.js"></script>
            <script type="text/javascript">
                $( document ).ready(function() {

	                var calendar = $("#calendar").calendar(
		                {
			                tmpl_path: "/bootstrap-calendar/tmpls/",
			                events_source:  "/producer-events/<?php echo $producer->org_name; ?>"
		                });

                $('.btn-group button[data-calendar-nav]').each(function() {
		                var $this = $(this);
		                $this.click(function() {
			                calendar.navigate($this.data('calendar-nav'));
		                });
	                });

	                $('.btn-group button[data-calendar-view]').each(function() {
		                var $this = $(this);
		                $this.click(function() {
			                calendar.view($this.data('calendar-view'));
		                });
	                });

                });

            </script>
            <!-- End Boostrap calendar -->

            <div class="col-sm-6">
                <ul class="calendar-events">
                <?php if (count($campaigns) > 0) {
                        foreach ($campaigns as $campaign) {
                ?>
                    <li>
                        <strong><?php echo date_format($campaign->start_date, 'F d, Y '); ?></strong>
                        &nbsp;&nbsp;&nbsp; 
                        <a href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">
                            <?php echo $campaign->campaign_name; ?>
                        </a>
                    </li>
                <?php } } ?>
                </ul>
            </div>

        </div>

        <div class="row" id="supporters-list">

            <div class="col-sm-12">                        
                    <?php
                    if (count($campaigns) > 0) {
                    foreach ($campaigns as $campaign){ 
                    ?>
                <!--Pricing Column-->
                <article class="pricing-column col-sm-4">
                    <div class="inner-box fadeIn animated wow" data-wow-delay=".1s">
                        <div class="plan-header text-center">
                            <h3 class="plan-title"><a href="supporter/campaign/<?php echo $campaign->friendly_url; ?>">
                                    <?php echo $campaign->campaign_name; ?></a></h3>

                            <div class="thumbnail thumbnail-box">
                                <a href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">
			                        <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?> "  style="max-height: 450px;" width="300" height="500"/>
                                </a>
		                     </div>

                        </div>

                        <?php if (isset($_SESSION['user_type'])) { ?>
                        <form action="/save-campaign-alert-preference" method="POST" id="pref">
                            <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>">
                            <div class="btn-preference">
                                <button type="submit" name="preference" value="yes" class="btn btn-success">Yes</button>
                                <button type="submit" name="preference" value="no" class="btn btn-danger">No</button>
                                <button type="submit" name="preference" value="maybe" class="btn btn-info">Maybe</button>
                            <div>
                        </form>

                        <div>
                            <button class="btn support-btns" id="share-it" href="#share-buttons">
                                Share
                            </button>
                        </div>

                        <?php } ?>

                        </div>
                </article>
            <?php } }?>

            </div><!-- end column -->

        </div><!-- end row -->


        <div class="row">

             <div class="col-sm-12">
                    <div class="col-sm-12" style="text-align:left;">
                        <div class="row"><h3>About <?php echo $producer->org_name; ?></h3>
                        </div>
                        <div class="row">
                            <?php echo $producer->description; ?>
                        </div>
                    </div>
             </div>
        </div>


    </div><!--end container -->
</section><!--end section -->
