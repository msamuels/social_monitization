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