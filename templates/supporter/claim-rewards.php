
<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6 intro-form">

                <H3>Claim Rewards </H3>

                <div id="status">
                    <p><?php echo $reward->reward_name ?></p>
                    <p><a href="/claim-rewards"> <img src="/images/rewards/<?php echo $reward->image; ?>"
                                                      height="100" width="100"/></a>
                    </p>
                    <p>Points: <?php echo $reward->point_value; ?></p>
                    <p>Your Points: <?php echo  $pointsEarned; ?></p>
                </div>

                <?php if (!empty($email_error)) { ?>
                    <div class="alert alert-danger"><?php echo $email_error; ?></div>
                <?php } ?>

                <?php if (!empty($username_error)) { ?>
                    <div class="alert alert-danger"><?php echo $username_error; ?></div>
                <?php } ?>

                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <p>Clicking 'redeem' button, reward will be send to email address listed</p>

                <form action="/do-claim-reward" method="POST" id="login" class="form-horizontal">

                    <input type="hidden" name="reward_id" value="<?php echo $reward->reward_id ?>" />

                    <div class="form-group">
                        <label class="control-label col-sm-4">Claim reward</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" value="<?php echo $supporter->email_address; ?>"/>
                        </div>
                    </div>

                    <br />
                    
                    <p style="text-align:center">
                        <?php if($reward->point_value > $pointsEarned) { ?>
                           <button class="btn btn-primary" type="submit">Not enough points to redeem</button>
                        <?php } else { ?>
                            <button class="btn btn-primary" type="submit">Redeem</button>
                        <?php } ?>
                    </p>

                </form>
            </div>

        </div>

        <div class="col-sm-3"></div>


    </div> <!-- end container -->
</section>
<!-- END HOME -->
