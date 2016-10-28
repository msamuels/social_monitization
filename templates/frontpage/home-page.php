  <!-- HOME -->
  <section class="home bg-img-2" id="home">
  <div class="bg-overlay"></div>
    <!-- <div class="bg-overlay"></div> -->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          <div class="home-wrapper text-center">
              <h2 class="animated fadeInDown wow text-white" data-wow-delay=".1s">
                  Support. This Simple Investment Makes <span class="text-colored">A Big Difference</span>
              </h2>
              <p class="animated fadeInDown wow text-light animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">
                Shareticamp is a community supporting projects and causes by sharing them across their networks.
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
                      <p class="title-alt">Sharing</p>
                      <h3 class="fadeIn animated wow" data-wow-delay=".1s">How Shareitcamp Works</h3>
                      <div class="border"></div>
                  </div>
              </div>
          </div> <!-- end row -->

          <div class="row text-center">
              <div class="col-sm-4">
                  <div class="service-item animated fadeInLeft wow" data-wow-delay=".1s">
                      <img src="images/icons/idea.svg" width="48" alt="img">
                      <div class="service-detail">
                          <h4>Organizations Post Projects</h4>
                          <p>We work with organizations who are focused on making a positive impact on the communities they serve. These organizations join our platform and post information related to the work they are doing (think toy drives, fundraisers, petitions, or products and services).</p>
                      </div> <!-- /service-detail -->
                  </div> <!-- /service-item -->
              </div> <!-- /col -->

              <div class="col-sm-4">
                  <div class="service-item animated fadeInDown wow" data-wow-delay=".3s">
                      <img src="images/icons/share.svg" width="48" alt="img">
                      <div class="service-detail">
                          <h4>You Share It</h4>
                          <p>You are alerted by email once a new campaign is posted. Support the campaigns you like (by clicking support) and sharing it with the social network you like. </p>
                      </div> <!-- /service-detail -->
                  </div> <!-- /service-item -->
              </div> <!-- /col -->

              <div class="col-sm-4">
                  <div class="service-item animated fadeInRight wow" data-wow-delay=".5s">
                      <img src="images/icons/rating.svg" width="48" alt="img">
                      <div class="service-detail">
                          <h4>You Receive Points</h4>
                          <p>For each campaign you support, you will receive points. It’s like a regular rewards program, but instead of shopping and getting points, you get point for supporting an initiative.  </p>
                      </div> <!-- /service-detail -->
                  </div> <!-- /service-item -->
              </div> <!-- /col -->
          </div> <!--end row -->

	    </div> <!-- end container -->
  </section>
  <!-- END FEATURES -->

  <!-- FEATURES-ALT -->
  <section class="section bg-gray" id="features">
      <div class="container">

          <div class="row">
              <div class="col-sm-6">
                  <div class="feature-detail">

                      <div class="title-box">
                          <p class="title-alt">Rewards</p>
                          <h3 class="fadeIn animated wow" data-wow-delay=".1s">Our Way of Saying Thanks</h3>
                          <div class="border"></div>
                      </div>

                      <ul class="zmdi-hc-ul">
                          <li class="fadeIn animated wow" data-wow-delay=".1s"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Receive points for each campaign you support.</span></li>

                          <li class="fadeIn animated wow" data-wow-delay=".2s"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Redeem those points for an Amazon gift card </span></li>

                          <li class="fadeIn animated wow" data-wow-delay=".3s"><i class="zmdi-hc-li zmdi zmdi-caret-right-circle text-colored"></i><span class="text-muted">Feel Good!</span></li>


                      </ul>

                      <a href="" class="btn btn-primary btn-shadow btn-rounded w-lg animated fadeInDown wow" data-wow-delay=".4s">Get Started</a>
                  </div>
              </div>

              <div class="col-sm-6">
                  <img src="images/amazongiftcard.png" class="img-responsive fadeIn animated wow" data-wow-delay=".2s">
              </div>

          </div>
      </div>
  </section>
  <!-- END FEATURES-ALT -->

  <section class="section" id="features">
      <div class="container">

          <div class="row">
              <div class="col-sm-12 text-center">
                  <div class="title-box">
                      <p class="title-alt"><a name="projects">Projects</a></p>
                      <h3 class="fadeIn animated wow" data-wow-delay=".1s">Work Worth Sharing</h3>
                      <div class="border"></div>
                  </div>
              </div>
          </div> <!-- end row -->

     <div class="row">
            <?php if(count($campaigns) > 0){ ?>
        <!--Pricing Column-->
        <article class="pricing-column col-sm-4">
            <div class="inner-box fadeIn animated wow" data-wow-delay=".1s">
                <div class="plan-header text-center">
                    <h3 class="plan-title"><a href="supporter/campaign/<?php echo $campaigns[0]->friendly_url; ?>">
                            <?php echo $campaigns[0]->campaign_name; ?></a></h3>
                    <h2 class="plan-duration"> by <a href="/producer/<?php echo $campaigns[0]->getProducer()->friendly_url; ?>">
                            <?php echo $campaigns[0]->getProducer()->org_name; ?></a></h2>
                    <div class="thumbnail thumbnail-box">
                        <a href="supporter/campaign/<?php echo $campaigns[0]->friendly_url; ?>">
			                <img src="/images/screenshots/<?php echo $campaigns[0]->screen_shot; ?> "  style="max-height: 450px;" width="300" height="500"/>
                        </a>
		             </div>

                </div>

                <div class="text-center">
                    <a href="supporter/campaign/<?php echo $campaigns[0]->friendly_url; ?>" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
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
                            <?php echo $campaigns[1]->campaign_name; ?></a></h3>
                    <h2 class="plan-duration"> by <a href="/producer/<?php echo $campaigns[1]->getProducer()->friendly_url; ?>">
                        <?php echo $campaigns[1]->getProducer()->org_name; ?></a></h2>
                    <div class="thumbnail thumbnail-box">
                        <a href="supporter/campaign/<?php echo $campaigns[1]->friendly_url; ?>">
			                <img src="/images/screenshots/<?php echo $campaigns[1]->screen_shot; ?> "  style="max-height: 450px;" width="300" height="500"/>
                        </a>
		            </div>

                </div>
   

                <div class="text-center">
                    <a href="supporter/campaign/<?php echo $campaigns[1]->friendly_url; ?>" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
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
                            <?php echo $campaigns[2]->campaign_name; ?></a></h3>
                    <h2 class="plan-duration"> by <a href="/producer/<?php echo $campaigns[2]->getProducer()->friendly_url; ?>">
                        <?php echo $campaigns[2]->getProducer()->org_name; ?></a></h2>
                    <div class="thumbnail thumbnail-box">
                        <a href="supporter/campaign/<?php echo $campaigns[2]->friendly_url; ?>">
			                <img src="/images/screenshots/<?php echo $campaigns[2]->screen_shot; ?> "  style="max-height: 450px;" width="300" height="500"/>
                        </a>
		             </div>

                </div>
   

                <div class="text-center">
                    <a href="supporter/campaign/<?php echo $campaigns[2]->friendly_url; ?>" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
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
                            <?php echo $campaigns[3]->campaign_name; ?></a></h3>
                    <h2 class="plan-duration"> by <a href="/producer/<?php echo $campaigns[3]->getProducer()->friendly_url; ?>">
                        <?php echo $campaigns[3]->getProducer()->org_name; ?></a></h2>
                    <div class=""thumbnail thumbnail-box">
                    <a href="supporter/campaign/<?php echo $campaigns[3]->friendly_url; ?>">
			            <img src="/images/screenshots/<?php echo $campaigns[3]->screen_shot; ?> "  style="max-height: 450px;" width="300" height="500"/>
                    </a>
		    </div>

                </div>
   

                <div class="text-center">
                    <a href="supporter/campaign/<?php echo $campaigns[3]->friendly_url; ?>" class="btn btn-primary btn-shadow w-md btn-rounded">Support</a>
                </div>
            </div>
        </article>
<?php } ?>
      </div><!-- end row -->

    </div> <!-- end container -->
  </section>
  <!-- END PRICING -->

