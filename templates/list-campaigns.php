<H1>Campaigns</H1>

<table>
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

foreach($campaigns as $campaigns){

?>
    <tr>
    <?php echo '<td>'.$campaigns->campaign_name. '</td>'; ?>

    <?php echo '<td> -- </td>'; ?>

        <?php echo '<td>'.$campaigns->start_date. '/'.$campaigns->end_date.'</td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td>'.$campaigns->approved. '</td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td> -- </td>'; ?>

        <?php echo '<td> -- </td>'; ?>
    </tr>

<?php
}
?>


</table>

