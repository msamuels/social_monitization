<!-- Show campaigns supported -->
<H1>Supported Campaigns</H1>

<table border="1px solid grey">
    <tr>
        <td>Campaign Name </td>
        <td>Producer </td>
        <td>Budget </td>
        <td>Start/End Date </td>
        <td># Supporters </td>
        <td>Creative </td>
        <td>Approve/Decline </td>
        <td>CPM </td>
        <td>Impression (Planned) </td>
        <td>Impression (Delivered) </td>
    <tr>

        <?php

        foreach($supported_campaigns as $supported_campaign){

        ?>
    <tr>
        <?php echo '<td>'.$supported_campaign->campaign->campaign_name. '</td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td>--</td>'; ?>

        <?php echo '<td>'.$supported_campaign->campaign->start_date. '/'.$supported_campaign->campaign->end_date.'</td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td>'.$supported_campaign->campaign->approved. '</td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td> -- </td>'; ?>
    </tr>

    <?php
    }
    ?>


</table>
