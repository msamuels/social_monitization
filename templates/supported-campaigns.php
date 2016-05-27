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
    <tr>

        <?php

        foreach($supported_campaigns as $supported_campaign){

        ?>
    <tr>
        <?php echo '<td><a href="/supporter/campaign/1">'.$supported_campaign->campaign->campaign_name. '</a></td>'; ?>

        <?php echo '<td>--</td>'; ?>

        <td> <img src="images/screenshots/<?php echo $supported_campaign->campaign->screen_shot; ?>" /> </td>

	<td>--</td>


    </tr>

    <?php
    }
    ?>


</table>
</div>
