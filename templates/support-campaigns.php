<!-- @TODO remove margin-top -->
<div style="margin-top: 200px">
<H1>Campaigns</H1>

<table border="1px solid grey">
    <tr>
        <td>Campaign</td>
        <td>Producer </td>
        <td>Budget </td>
        <td>Start/End Date </td>
        <td>Creative </td>
        <td>CPM </td>
        <td>Impression (Planned) </td>
        <td>Impression (Delivered) </td>
        <td>Respond needed by</td>
        <td>Copy</td>
    <tr>

        <?php
        if(count($campaigns) > 0) {
            foreach($campaigns as $campaign){

            ?>
                <tr>
                    <td><a href="/campaings?id=<?php echo $campaign->campaign_id; ?>">
			<?php echo $campaign->campaign_name; ?></a> <br />
			<img src="images/screenshots/<?php echo $campaign->screen_shot; ?>" />
		    </td>

                    <td> -- </td>

                    <td> -- </td>

                    <td><?php echo date_format($campaign->start_date, 'Y-m-d '). '/'.date_format($campaign->end_date, 'Y-m-d '); ?></td>

                    <td>
                        <form action="/save-campaign-support" method="POST">
                            <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>" />
                            <input type="hidden" name="supporter_id" value="<?php echo $user_id; ?>" />
                            <button class="btn btn-primary" type="submit" >Support Campaign</button>
                        </form>
                    </td>

                    <td> -- </td>

                    <td> -- </td>

                    <td> -- </td>

                    <td> -- </td>

		    <td> <?php echo $campaign->copy; ?> </td>
                </tr>

        <?php
        }

    } else {
        echo "No campaigns found";
    }
    ?>


</table>

</div>
