<H1>Invoice: </H1>

<H3><?php echo $campaign->campaign_name; ?></H3>

<H3>Supporters: </H3>
<ul style="border-color: #222222">
	<?php

	foreach($supporters as $supporter){

	?>
		<li style="border: solid; border-color: #0f0f0f; margin-right: 2px; width:200px; float: left">
			<?php echo $supporter->email_address; ?>
			<?php echo $supporter->id_follower_count; ?>
		</li>

	<?php
	}
	?>
</ul>

<H2>Details</H2> 
	Duration: <?php echo $campaign->start_date; ?> - <?php echo $campaign->end_date; ?>
<br />
	Platforms:

<H2>Impressions:</H2>
<?php

$i = 0;
foreach($supporters as $supporter){

    $i += $supporter->id_follower_count;
}

?>

Estimated: <input type="text" name="estimated_impression" value="<?php echo $i; ?>"/>
Actual: <input type="text" name="actual_impression" value=""/>



<H2>Cost: </H2>
Estimated: <input type="text" name="estimated_impression" value="<?php echo $campaign->budget; ?>"/>
Actual: <input type="text" name="actual_impression" value="<?php echo $campaign->budget; ?>"/>


<H2>Final Bill: </H2>
<input type="text" name="final_cost" value="100000"/>


<br />
By approving this plan you will be billed the above
<br />

<form action="/approve-campaign" method="POST" class="form-horizontal" role="form">

<input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>"/>

<button class="btn btn-primary" type="submit" >Approve</button>
</form>
