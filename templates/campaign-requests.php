<H1>Campaigns</H1>
<ul style="border-color: #222222">
        <?php

        foreach($supporters as $supporter){

        ?>
    <li>
        <?php echo $supporter->user_name; ?>
        <?php echo $supporter->id_follower_count; ?>
    </li>

    <?php
    }
    ?>
</ul>

<H1>Estimated Impressions</H1>

<?php
$i = 0;
foreach($supporters as $supporter){

    $i += $supporter->id_follower_count;
}

echo $i;
?>


<H1>Estimated Cost</H1>

<H1>Details</H1>

<button class="btn btn-primary" type="submit" >Approve</button>