<div class="row">

    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        My Points:
        <H1><?php echo $points_earned; ?></H1>

        <H1>Rewards</H1>

        <ul class="list-rewards">
            <?php

            foreach ($rewards as $reward) {
                ?>
                <li>
                    <p><img src="images/rewards/<?php echo $reward->image; ?>" height="100" width="100"/></p>
                    <p><?php echo $reward->reward_name ?></p>
                    <p><?php echo $reward->point_value; ?> Pts</p>
                </li>
                <?php
            }
            ?>

        </ul>


    </div>
</div>

<div class="col-sm-3"></div>