  <!-- HOME -->
  <section class="home bg-img-2" id="home">
  <div class="bg-overlay"></div>
    <!-- <div class="bg-overlay"></div> -->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          <div class="home-wrapper text-center">
            <h2 class="animated fadeInDown wow text-white" data-wow-delay=".1s">
              Lend Your Support
            </h2>
            <p class="animated fadeInDown wow text-muted" data-wow-delay=".2s">
               a simple investment today<br /> for a greater return <br />tomorrow
            </p>
            <a href="/get-started/supporter/register" class="btn btn-primary btn-shadow btn-rounded w-lg animated fadeInDown wow" data-wow-delay=".4s">Get Started</a>
            <div class="clearfix"></div>
          </div><!-- home wrapper -->

        </div> <!-- end col -->
      </div> <!-- end row -->
    </div> <!-- end container -->
  </section>
  <!-- END HOME -->

  <!-- FEATURES -->
  <section class="section" id="features">
    <div class="container">

      <div class="row">
        <div class="col-sm-12 text-center">
          <div class="title-box">
            <h3 class="fadeIn animated wow" data-wow-delay=".1s">How it works</h3>
            <div class="border"></div>
          </div>
        </div> 
      </div> <!-- end row -->

      <div class="row text-center">
        <div class="col-sm-4">
          <div class="service-item animated fadeInLeft wow" data-wow-delay=".1s">
            <img src="images/no1.png" width="48" alt="img">
            <div class="service-detail">
              <h4>Organizations post campaign</h4>
              <p>We put a lot of effort in design, as it’s the most important ingredient of successful website.Sed ut perspiciatis unde omnis iste natus error sit.</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->

        <div class="col-sm-4">
          <div class="service-item animated fadeInDown wow" data-wow-delay=".3s">
            <img src="images/no2.png" width="48" alt="img">
            <div class="service-detail">
              <h4>You Share It</h4>
              <p>You share the campaigns you like with your social network</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->

        <div class="col-sm-4">
          <div class="service-item animated fadeInRight wow" data-wow-delay=".5s">
            <img src="images/no3.png" width="48" alt="img">
            <div class="service-detail">
              <h4>You Receive Points</h4>
              <p>You receive points that can be redeemed for rewards</p>
            </div> <!-- /service-detail -->
          </div> <!-- /service-item -->
        </div> <!-- /col -->       
      </div> <!--end row -->

	    </div> <!-- end container -->
  </section>
  <!-- END FEATURES -->


     <div class="row">
            <?php if(count($campaigns) > 0){ ?>
        <!--Pricing Column-->
        <article class="pricing-column col-sm-4">
            <div class="inner-box fadeIn animated wow" data-wow-delay=".1s">
                <div class="plan-header text-center">
                    <h3 class="plan-title"><a href="supporter/campaign/<?php echo $campaigns[0]->friendly_url; ?>">
                            <?php echo $campaigns[0]->campaign_name; ?></h3>
                    <h2 class="plan-duration"> by <?php echo $campaigns[0]->getProducer()->org_name; ?></h2>
                    <div>
			<img src="/images/screenshots/<?php echo $campaigns[0]->screen_shot; ?> "  width="300" height="500" />
		    </div>

                </div>

                <div class="text-center">
                    <a href="#" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
                </div>
            </div>
        </article>
            <?php } ?>

 <?php if(count($campaigns) > 1){ ?>
        <!--Pricing Column-->
        <article class="pricing-column col-sm-4">
            <div class="inner-box fadeIn animated wow" data-wow-delay=".2s">
                <div class="plan-header text-center">
                    <h3 class="plan-title"><a href="supporter/campaign/<?php echo $campaigns[1]->friendly_url; ?>">
                            <?php echo $campaigns[1]->campaign_name; ?></h3>
                    <h2 class="plan-duration"> by <?php echo $campaigns[1]->getProducer()->org_name; ?></h2>
                    <div>
			<img src="/images/screenshots/<?php echo $campaigns[1]->screen_shot; ?> "  width="300" height="500" />
		    </div>

                </div>
   

                <div class="text-center">
                    <a href="#" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
                </div>
            </div>
        </article>
<?php } ?>

 <?php if(count($campaigns) > 2){ ?>
        <!--Pricing Column-->
        <article class="pricing-column col-sm-4">
            <div class="inner-box fadeIn animated wow" data-wow-delay=".3s">
                <div class="plan-header text-center">
                    <h3 class="plan-title"><a href="supporter/campaign/<?php echo $campaigns[2]->friendly_url; ?>">
                            <?php echo $campaigns[2]->campaign_name; ?></h3>
                    <h2 class="plan-duration"> by <?php echo $campaigns[2]->getProducer()->org_name; ?></h2>
                    <div>
			<img src="/images/screenshots/<?php echo $campaigns[2]->screen_shot; ?> "  width="300" height="500" />
		    </div>

                </div>
   

                <div class="text-center">
                    <a href="#" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
                </div>
            </div>
        </article>
<?php } ?>
 <?php if(count($campaigns) > 3){ ?>
        <!--Pricing Column-->
        <article class="pricing-column col-sm-4">
            <div class="inner-box fadeIn animated wow" data-wow-delay=".4s">
                <div class="plan-header text-center">
                    <h3 class="plan-title"><a href="supporter/campaign/<?php echo $campaigns[3]->friendly_url; ?>">
                            <?php echo $campaigns[3]->campaign_name; ?></h3>
                    <h2 class="plan-duration"> by <?php echo $campaigns[3]->getProducer()->org_name; ?></h2>
                    <div>
			<img src="/images/screenshots/<?php echo $campaigns[3]->screen_shot; ?> "  width="300" height="500" />
		    </div>

                </div>
   

                <div class="text-center">
                    <a href="#" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
                </div>
            </div>
        </article>
<?php } ?>
      </div><!-- end row -->

    </div> <!-- end container -->
  </section>
  <!-- END PRICING -->

