<div class="row">

    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        <H1>Rewards</H1>

        <?php if (isset($success_info)) { ?>
            <div class="alert alert-success"><?php echo $success_info; ?></div>
        <?php } ?>

        <ul class="list-rewards">
            <?php

            foreach ($rewards as $reward) {
                ?>
                <li>
                    <p><img src="images/rewards/<?php echo $reward->image; ?>" height="100" width="100"/></p>
                    <p><?php echo $reward->reward_name ?></p>
                </li>
                <?php
            }
            ?>

        </ul>

    </div>
</div>

<div class="col-sm-3"></div>