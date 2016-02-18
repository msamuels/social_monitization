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

        foreach($campaigns as $campaigns){

        ?>
    <tr>
        <?php echo '<td>'.$campaigns->campaign_name. '</td>'; ?>

        <td> -- </td>

        <td> -- </td>

        <?php echo '<td>'.$campaigns->start_date. '/'.$campaigns->end_date.'</td>'; ?>

        <td> -- </td>

        <?php echo '<td>'; ?>
            <form action="/save-campaign-support" method="POST">
                <input type="hidden" name="campaign_id" value="<?php echo $campaigns->campaign_id; ?>" />
                <!-- @TODO remove hard-coded supporter id -->
                <input type="hidden" name="supporter_id" value="1" />
                <button class="btn btn-primary" type="submit" >Support Campaign</button>
            </form>
            </td>

        <td> -- </td>

        <td> -- </td>

        <td> -- </td>
    </tr>

    <?php
    }
    ?>


</table>

