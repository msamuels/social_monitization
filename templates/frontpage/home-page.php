  <!-- FEATURED CAMPAIGN -->

  <!-- FEATURED CAMPAIGN-->

  <!-- HOME -->
  <section class="home bg-img-2" id="home">
  <div class="bg-overlay"></div>
    <!-- <div class="bg-overlay"></div> -->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          <div class="home-wrapper text-center">
              <h2 class="animated fadeInDown wow text-white" data-wow-delay=".1s">
                  Share projects with your social netwoks and earn reward points!
              </h2>
              <p class="animated fadeInDown wow text-light animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">
                Shareticamp is a platform where individuals get together to help promote intiatives that matter to them.
            </p>
            <a href="/get-started/supporter/register" class="btn btn-primary btn-shadow btn-rounded w-lg animated fadeInDown wow" data-wow-delay=".4s">Join ShareItCamp</a>
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
                          <p>We work with organizations who are focused on making a positive impact in the communities they serve. These organizations join our platform and post projects they would like promoted (e.g. fundraisers, services, programs, etc.).</p>
                      </div> <!-- /service-detail -->
                  </div> <!-- /service-item -->
              </div> <!-- /col -->

              <div class="col-sm-4">
                  <div class="service-item animated fadeInDown wow" data-wow-delay=".3s">
                      <img src="images/icons/share.svg" width="48" alt="img">
                      <div class="service-detail">
                          <h4>You Share It</h4>
                          <p>You are alerted by email once a new project is posted. You can help promote the project you like by sharing it with the social networks. </p>
                      </div> <!-- /service-detail -->
                  </div> <!-- /service-item -->
              </div> <!-- /col -->

              <div class="col-sm-4">
                  <div class="service-item animated fadeInRight wow" data-wow-delay=".5s">
                      <img src="images/icons/rating.svg" width="48" alt="img">
                      <div class="service-detail">
                          <h4>You Receive Points</h4>
                          <p>For each project you share you earn 'rewared points'.  </p>
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
            <?php foreach ($campaigns as $campaign){ ?>
        <!--Pricing Column-->
        <article class="pricing-column col-sm-4">
            <div class="inner-box fadeIn animated wow" data-wow-delay=".1s">
                <div class="plan-header text-center">
                    <h3 class="plan-title"><a href="supporter/campaign/<?php echo $campaign->friendly_url; ?>">
                            <?php echo $campaign->campaign_name; ?></a></h3>
                    <h2 class="plan-duration"> by <a href="/producer/<?php echo $campaign->getProducer()->friendly_url; ?>">
                            <?php echo $campaign->getProducer()->org_name; ?></a></h2>
                    <div class="thumbnail thumbnail-box">
                        <a href="supporter/campaign/<?php echo $campaign->friendly_url; ?>">
			                <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?> "  style="max-height: 450px;" width="300" height="500"/>
                        </a>
		             </div>

                </div>
        </article>
    <?php } ?>
      </div><!-- end row -->

    </div> <!-- end container -->
  </section>
  <!-- END PRICING -->

