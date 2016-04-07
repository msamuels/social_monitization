<H1>Campaigns</H1> <a href="create-campaign">Create Campaign</a>

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
</tr>

<?php

foreach($campaigns as $campaign){

?>
    <tr>
        <td><a href="/campaigns?id=<?php echo $campaign->campaign_id; ?>"><?php echo $campaign->campaign_name; ?></a></td>

        <td> -- </td>

        <td>--</td>

       <td><?php echo $campaign->start_date. '/'.$campaign->end_date; ?></td>

        <td> -- </td>

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

