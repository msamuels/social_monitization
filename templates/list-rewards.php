<H1>Rewards</H1>

<ul>
<?php

foreach ($rewards as $reward) {
?>
        <li>
            <p><?php echo $reward->reward_name ?></p>
            <p><?php echo $reward->point_value; ?></p>
        </li>
<?php
}
?>

</ul>