<H1>Campaigns</H1>

<table>
<tr>
    <td>Campaign Name </td>
    <td>Budget </td>
    <td>First Name </td>
    <td>First Name </td>
    <td>First Name </td>
    <td>First Name </td>
<tr>

<?php

foreach($campaigns as $campaigns){

?>
    <tr>
    <?php echo '<td>'.$campaigns->campaign_name. '</td>'; ?>
    </tr>
    <tr>
    <?php echo '<td>'.$campaigns->budget. '</td>'; ?>
    </tr>

<?php
}
?>


</table>
