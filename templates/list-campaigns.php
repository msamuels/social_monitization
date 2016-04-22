<H1>Campaigns</H1>

<?php if(isset($success_info)){ ?>
    <div class="alert alert-success"><?php echo $success_info; ?></div>
<?php } ?>

<table border="1px solid grey;">
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
</tr>

<?php

foreach($campaigns as $campaign){

?>
    <tr>
        <td><a href="/campaign-detail?id=<?php echo $campaign->campaign_id; ?>"><?php echo $campaign->campaign_name; ?></a></td>

        <td> -- </td>

        <td>$<?php echo $campaign->budget; ?></td>

       <td><?php echo date_format($campaign->start_date, 'Y-m-d '). ' - '.date_format($campaign->end_date, 'Y-m-d '); ?></td>

        <td> <?php echo $campaign->num_supporters; ?> </td>

        <td><?php echo $campaign->approved; ?></td>

        <td> -- </td>

        <td> -- </td>

        <td> -- </td>

        <td> -- </td>
    </tr>

<?php
}
?>


</table>

