<H1>Campaigns</H1>

<table border="1px solid grey">
    <tr>
        <td>Campaign Name </td>
        <td>Producer </td>
        <td>Budget </td>
        <td>Start/End Date </td>
        <td># Supporters </td>
        <td>Creative </td>
        <td>CPM </td>
        <td>Impression (Planned) </td>
        <td>Impression (Delivered) </td>
    <tr>

        <?php
        if(count($campaigns) > 0) {
            foreach($campaigns as $campaign){

            ?>
                <tr>
                    <td><a href="/campaings?id=<?php echo $campaign->campaign_id; ?>"><?php echo $campaign->campaign_name; ?></a></td>

                    <td> -- </td>

                    <td> -- </td>

                    <td><?php echo $campaign->start_date. '/'.$campaign->end_date; ?></td>

                    <td> -- </td>

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
                </tr>

        <?php
        }

    } else {
        echo "No capaigns found";
    }
    ?>


</table>

