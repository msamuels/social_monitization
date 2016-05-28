<H1>Invoice: </H1>

<H3><?php echo $campaign->campaign_name; ?></H3>

<p><img src="images/screenshots/<?php echo $campaign->screen_shot; ?>" /></p>

<H3>Supporters: </H3>

<div class="row" id="supporters-list" style="margin-left:300px">
<ul style="border-color: #222222">
	<?php
	if (count($supporters) > 0) {
		foreach($supporters as $supporter){

		?>
			<li style="border: solid; border-color: #0f0f0f; margin-right: 2px; width:200px; float: left">
				<?php echo $supporter->email_address; ?>
				<?php echo $supporter->id_follower_count; ?>
			</li>

		<?php
		}
	}
	?>
</ul>
</div>

<div class="row">

<H2>Details</H2>
	<label>Duration:</label> <?php echo date_format($campaign->start_date, 'Y-m-d '); ?> -
	<?php echo date_format($campaign->end_date, 'Y-m-d '); ?>
<br />
		<label>Platforms:</label>

<H2>Impressions:</H2>
<?php

$i = 0;
if (count($supporters) > 0) {
	foreach ($supporters as $supporter) {

		$i += $supporter->id_follower_count;
	}
}
?>
</div>
<label>Estimated:</label> <input type="text" name="estimated_impression" value="<?php echo $campaign->estimate; ?>"/>
<label>Actual:</label> <input type="text" name="actual_impression" value=""/>



<H2>Cost: </H2>
<label>Estimated:</label> <input type="text" name="estimated_impression" value="<?php echo $campaign->budget; ?>"/>
<label>Actual:</label> <input type="text" name="actual_impression" value=""/>


<H2>Final Bill: </H2>
<input type="text" name="final_cost" value="100000"/>


<br />
By approving this plan you will be billed the above
<br />

<form action="/approve-campaign" method="POST" class="form-horizontal" role="form">

<input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>"/>

<button class="btn btn-primary" type="submit" >Approve</button>
</form>
