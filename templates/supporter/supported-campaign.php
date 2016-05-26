<!-- @TODO remove margin-top -->
<div style="margin-top: 200px">
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

            foreach($campaign as $campaign){

            ?>
        <tr>
            <?php echo '<td>'.$campaign->campaign_name. '</td>'; ?>

            <?php echo '<td> -- </td>'; ?>

            <?php echo '<td>--</td>'; ?>

            <td><?php echo date_format($campaign->start_date, 'Y-m-d '). ' - '.date_format($campaign->end_date, 'Y-m-d '); ?></td>

            <?php echo '<td> -- </td>'; ?>

            <?php echo '<td>'.$campaign->approved. '</td>'; ?>

            <?php echo '<td> -- </td>'; ?>

            <?php echo '<td> -- </td>'; ?>

            <?php echo '<td> -- </td>'; ?>

            <?php echo '<td> -- </td>'; ?>
        </tr>

        <?php
        }
        ?>


    </table>
</div>
