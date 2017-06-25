<section class="section" id="features">
    <div class="container">

        <H1><?php echo $producer->org_name; ?></H1>

        <?php if (isset($success_info)) { ?>
            <div class="alert alert-warning"><?php echo $success_info; ?></div>
        <?php } ?>


        <div class="row" id="supporters-list">

          

             <div class="col-sm-6">
                    <div class="col-sm-12" style="text-align:left;">
                        <div class="row"><h3>About <?php echo $producer->org_name; ?></h3>
                        </div>
                        <div class="row">
                            <?php echo $producer->description; ?>
                        </div>
                    </div>
             </div>




            <div class="col-sm-6">
                <div class="row" style="text-align: left;"><h3><i>Initiatives</i></h3>
                        </div>

                <ul class="list-things" style="list-style: none">
                    <?php
                    if (count($campaigns) > 0) {
                        foreach ($campaigns as $campaign) {
                            ?>
                                <div>
                                    <li class="list-item">
                                        <p>
                                            <strong>
                                                <a href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">
                                                    <?php echo $campaign->campaign_name; ?>
                                                </a>
                                            </strong></p>
                                       
                                        <p class="by-line"><i> by <?php echo $campaign->getProducer()->org_name; ?></i></p>
                                       
                                        <div class="thumbnail thumbnail-box-prod">
                                            <a href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">
                                                <img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>"
                                                     style="max-height: 450px;margin-bottom: 15px;" height="500" width="300"/>
                                            </a>

                                              <div style="display: block;width: auto;margin: 0px 25px;"><?php echo substr($campaign->copy, 0, 50); ?>
                                            ...  <a style="text-decoration: underline"
                                                  href="/supporter/campaign/<?php echo $campaign->friendly_url; ?>">Learn More
                                                  </a>
                                                </div>

                                        </div>
                                      

                                    </li>
                                </div>
                            <?php
                        }
                    }
                    ?>

                </ul>
            </div>

        

        </div>






    </div><!--end container -->
</section><!--end section -->
