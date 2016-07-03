        <div class="row" id="get-started-banner">
            <H1 style="color: white" id="call-out">Lend Your Support</H1>
            <span style="color: white"> a simple investment today<br /> for a greater return <br />tomorrow</span>
            <p><a href="/get-started/supporter/register" class="btn support-btns">Get Started</a></p>
        </div>

        <div class="row" id="works"><H1>How it works</H1></div>

        <div class="row" id="how-it-works">

            <div class="col-sm-1 pull-left"></div>

            <div class="col-sm-3 pull-left">
                <div><img class="icon" src="images/no1.png"/></div>
                <div class="pull-left">
                    <H3>Organizations post campaign</H3>
                    <p class="desc">Producer posts promotional message to shareitcamp and supporters on platform are
                        notified</p>
                </div>
            </div>


            <div class="col-sm-3">
                <div><img class="icon" src="images/no2.png"/></div>
                <div class="pull-left">
                    <H3>You Share It</H3>
                    <p class="desc">You share the campaigns you like with your social network</p>
                </div>
            </div>

            <div class="col-sm-3 pull-left">
                <div><img class="icon" src="images/no3.png"/></div>
                <div class="pull-left">
                    <H3>You Receive Points</H3>
                    <p class="desc">You receive points that can be redeemed for rewards</p>
                </div>
            </div>

        </div>

        <div class="row">
                <H1>Campaigns</H1>
        </div>

        <div class="row">
            <div class="col-md-3">
                <p><a href="supporter/campaign/<?php echo $campaigns[0]->campaign_id; ?>">
                        <?php echo $campaigns[0]->campaign_name; ?>
                    </a>
                </p>
                <p><i> by <?php echo $campaigns[0]->getProducer()->org_name; ?></i></<p>

                <p><a href="supporter/campaign/<?php echo $campaigns[0]->campaign_id; ?>">
                    <img src="images/screenshots/<?php echo $campaigns[0]->screen_shot; ?>"/>
                    </a>
                </p>

                <a href="supporter/campaign/<?php echo $campaigns[0]->campaign_id; ?>" target="_parent">
                    <button class="btn support-btns">Support</button>
                </a>
            </div>


            <div class="col-md-3">
                <p><a href="supporter/campaign/<?php echo $campaigns[1]->campaign_id; ?>">
                        <?php echo $campaigns[1]->campaign_name; ?>
                    </a>
                </p>

                <p><i> by <?php echo $campaigns[1]->getProducer()->org_name; ?></i></<p>

                <p><a href="supporter/campaign/<?php echo $campaigns[1]->campaign_id; ?>">
                        <img src="images/screenshots/<?php echo $campaigns[1]->screen_shot; ?>"/>
                    </a>
                </p>

                <a href="supporter/campaign/<?php echo $campaigns[1]->campaign_id; ?>" target="_parent">
                    <button class="btn support-btns">Support</button>
                </a>
            </div>


            <div class="col-md-3">
                <p><a href="supporter/campaign/<?php echo $campaigns[2]->campaign_id; ?>">
                        <?php echo $campaigns[2]->campaign_name; ?>
                    </a>
                </p>

                <p><i> by <?php echo $campaigns[2]->getProducer()->org_name; ?></i></<p>

                <p><a href="supporter/campaign/<?php echo $campaigns[2]->campaign_id; ?>">
                        <img src="images/screenshots/<?php echo $campaigns[2]->screen_shot; ?>"/>
                    </a>
                </p>

                <a href="supporter/campaign/<?php echo $campaigns[2]->campaign_id; ?>" target="_parent">
                    <button class="btn support-btns">Support</button>
                </a>
            </div>


            <div class="col-md-3">
                <p><a href="supporter/campaign/<?php echo $campaigns[3]->campaign_id; ?>">
                        <?php echo $campaigns[3]->campaign_name; ?>
                    </a>
                </p>

                <p><i> by <?php echo $campaigns[3]->getProducer()->org_name; ?></i></<p>

                <p><a href="supporter/campaign/<?php echo $campaigns[3]->campaign_id; ?>">
                        <img src="images/screenshots/<?php echo $campaigns[3]->screen_shot; ?>"/>
                    </a>
                </p>

                <a href="supporter/campaign/<?php echo $campaigns[3]->campaign_id; ?>" target="_parent">
                    <button class="btn support-btns">Support</button>
                </a>
            </div>
        </div>

