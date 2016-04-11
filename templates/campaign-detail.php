<H1>Invoice: </H1>

<H3><?php echo $campaign->campaign_name; ?></H3>

<ul style="border-color: #222222">
	<?php

	foreach($supporters as $supporter){

	?>
		<li>
			<?php echo $supporter->email_address; ?>
			<?php echo $supporter->id_follower_count; ?>
		</li>

	<?php
	}
	?>
</ul>

<H2>Details</H2> 
	Duration: <?php echo $campaign->start_date; ?> - <?php echo $campaign->end_date; ?>

<H2>Estimated Impressions</H2>
	<?php echo $campaign->estimate; ?>
<?php
$i = 0;
	foreach($supporters as $supporter){

	    $i += $supporter->id_follower_count;
	}

echo $i;
?>


<H2>Estimated Cost: </H2>
<?php echo $campaign->budget; ?>

<br />
<button class="btn btn-primary" type="submit" >Approve</button>

