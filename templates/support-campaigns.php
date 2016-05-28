<!-- @TODO remove margin-top -->
<div style="margin-top: 200px;margin-left: 200px;">
<H1>Campaigns</H1>

<table border="1px solid grey">
    <tr>
        <td>Campaign</td>
        <td>Support </td>
        <td>Response needed by</td>
        <td>Copy</td>
	<td>Url</td>
    <tr>

        <?php
        if(count($campaigns) > 0) {
            foreach($campaigns as $campaign){

            ?>
                <tr>
                    <td><a href="/campaings?id=<?php echo $campaign->campaign_id; ?>">
			<?php echo $campaign->campaign_name; ?></a> <br />
			<img src="/images/screenshots/<?php echo $campaign->screen_shot; ?>" width="150" />
		    </td>



                    <td>
                        <form action="/save-campaign-support" method="POST">
                            <input type="hidden" name="campaign_id" value="<?php echo $campaign->campaign_id; ?>" />
                            <input type="hidden" name="supporter_id" value="<?php echo $user_id; ?>" />
                            <button class="btn btn-primary" type="submit" >Support Campaign</button>
                        </form>
                    </td>


                    <td> <?php echo date_format($campaign->end_date, 'Y-m-d '); ?> </td>

		    <td> <?php echo $campaign->copy; ?> </td>

		    <td> <?php echo $campaign->url; ?> </td>
                </tr>

        <?php
        }

    } else {
        echo "No campaigns found";
    }
    ?>


</table>

</div>
