<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

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

                <H1>Redeem Rewards</H1>

                <ul class="list-things">
                    <?php

                    foreach ($rewards as $reward) {
                        ?>
                        <li>
                            <p><a href="/claim-rewards/<?php echo $reward->reward_id; ?>">
                                    <img src="images/rewards/<?php echo $reward->image; ?>"
                                         height="100" width="100"/></a></p>
                            <p><?php echo $reward->reward_name ?></p>
                            <p><?php echo $reward->point_value; ?> Pts</p>
                            <a href="/claim-rewards/<?php echo $reward->reward_id; ?>" class="btn btn-primary"
                               type="submit">Redeem</a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>


            </div>
        </div>

        <div class="col-sm-3"></div>

    </div> <!-- end container -->
</section>
<!-- END HOME -->