<!-- @TODO remove margin-top -->
<div style="margin-top: 200px">
<!-- Show campaigns supported -->
<H1>Supported Campaigns</H1>

<?php if(isset($success_info)){ ?>
    <div class="alert alert-success"><?php echo $success_info; ?></div>
<?php } ?>

<table border="1px solid grey">
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

        <?php echo '<td>--</td>'; ?>

        <td> <img src="/images/screenshots/<?php echo $supported_campaign->campaign->screen_shot; ?>" /> </td>

	<td>--</td>

        <td>
		<form method="POST" action="/save-post-to-fb">
			<input type="hidden" name="message" id="messgae" value="<?php echo $supported_campaign->campaign->campaign_name; ?>" />
			
			<div class="fb-share-button" data-href="http://social.wilsonshop.biz/supporter/campaign/<?php echo $supported_campaign->campaign->campaign_id; ?>" data-layout="button_count" data-mobile-iframe="true"></div>
		</form>
	</td>
    </tr>

    <?php
    }
    ?>


</table>
</div>
