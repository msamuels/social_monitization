<H1>Supporters</H1>

<?php if (isset($success_info)) { ?>
    <div class="alert alert-success"><?php echo $success_info; ?></div>
<?php } ?>

<div class="row" id="supporters-list">

    <div class="col-sm-2"></div>

    <div class="col-sm-8">

        <ul class="list-things">
            <?php
            if (count($supporters) > 0) {
                $total_followers = 0;
                foreach ($supporters as $supporter) {
                    $total_followers += $supporter->id_follower_count;
                    ?>
                    <li class="list-item">
                        <p>
                                <?php echo $supporter->user_name; ?>
                        </p>
                        <p class="by-line"><i> Count: <?php echo $supporter->id_follower_count; ?></i></p>
                    </li>
                    <?php
                }
            }
            ?>

        </ul>
    </div>
    <div class="col-sm-2"></div>

</div>

<div class="row" id="supporters-list">
    Total followers: <?php echo $total_followers; ?>
</div>
