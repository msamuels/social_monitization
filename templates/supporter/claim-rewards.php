
<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6 intro-form">

                <H3>Claim Rewards </H3>

                <div class="row">

                    <div class="col-sm-4">
                        <p>Points Earned:</p>
                        <H1><?php echo $rewards_track['points_earned']; ?></H1>
                    </div>

                    <div class="col-sm-4">
                        <p>Points Claimed:</p>
                        <H1><?php echo $rewards_track['points_claimed']; ?></H1>
                    </div>

                    <div class="col-sm-4">
                        <p>Points Remaining:</p>
                        <H1><?php echo $rewards_track['points_remaining']; ?></H1>
                    </div>

                </div>
                
                <div id="status">
                    <H2><?php echo $reward->reward_name ?></H2>
                    <p><strong>Reward Points:</strong> <?php echo $reward->point_value; ?> </p>
                    <p><a href="/claim-rewards"> <img src="/images/rewards/<?php echo $reward->image; ?>"
                                                      height="100" width="100"/></a>
                    </p><strong>How will this  be provided:</strong> <br />
                    <?php echo $reward->details; ?>
                    </p>

                    </p><strong>Description:</strong> <br />
                    <?php echo $reward->description; ?>
                    </p>

                    <p><strong>Expiration Date:</strong>
                    <?php echo date_format($reward->expiration_date, 'F d, Y '); ?>
                    </p>

                    <p><strong>Reward Type:</strong>
                        <?php echo  $reward->type; ?>
                    </p>

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
                            <input type="text" class="form-control" name="email" disabled="disabled"
                                   value="<?php echo $supporter->email_address; ?>"/>
                        </div>
                    </div>

                    <br />
                    
                    <p style="text-align:center">

                        <?php if($is_reward_claimed) { ?>
                            <span class="btn btn-success" type="submit">Redeemed</span>
                        <?php } elseif(($reward->point_value < ($rewards_track['points_earned'] - $rewards_track['points_claimed'])) && $reward->type == "reward") { ?>
							<span class="btn btn-primary" type="submit">Not enough points to redeem</span>
						<?php } elseif(($reward->point_value > ($rewards_track['points_earned'] - $rewards_track['points_claimed'])) && $reward->type == "reward") { ?>
						<button class="btn btn-primary" type="submit">Redeem</button>
						<?php } elseif(($reward->point_value > ($rewards_track['points_earned'] - $rewards_track['points_claimed'])) && $reward->type == "raffle") { ?>
						<button class="btn btn-primary" type="submit">Enter Raffle</button>
					<?php } ?>
                    </p>

                </form>
            </div>

        </div>

        <div class="col-sm-3"></div>


    </div> <!-- end container -->
</section>
<!-- END HOME -->
