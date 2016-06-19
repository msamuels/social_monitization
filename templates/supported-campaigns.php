<!-- @TODO remove margin-top -->
<div style="margin-top: 200px; margin-left: 200px;"">
<!-- Show campaigns supported -->
<H1>Supported Campaigns</H1>

<?php if(isset($success_info)){ ?>
    <div class="alert alert-success"><?php echo $success_info; ?></div>
<?php } ?>

<table border="1px solid grey;" width="700">
    <tr>
        <td>Campaign Name </td>
        <td>Respond By Date </td>
        <td>Creative </td>
        <td>Points Earned</td>
        <td>Share</td>
    <tr>

        <?php

        foreach($supported_campaigns as $supported_campaign){

        ?>
    <tr>
        <td><a href="/supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?> "><?php echo $supported_campaign->campaign->campaign_name; ?> </a></td>

        <td><?php echo date_format($supported_campaign->campaign->end_date, 'Y-m-d '); ?></td>

        <td> <img src="/images/screenshots/<?php echo $supported_campaign->campaign->screen_shot; ?>"  width="150" /> </td>

	<td> 10 </td>

        <td>
		<form method="POST" action="/save-post-to-fb">
			<input type="hidden" name="message" id="messgae" value="<?php echo $supported_campaign->campaign->campaign_name; ?>" />
			
			<div class="fb-share-button" data-href="<?php echo $base_url; ?>/supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?>" data-layout="button_count" data-mobile-iframe="true"></div>
		</form>
	</td>
    </tr>

    <?php
    }
    ?>


</table>
</div>
