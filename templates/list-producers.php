<H1>Producers</H1>

<table  border=1>
<tr>
    <td>First Name </td>
    <td>Last Name </td>
    <td>username</td>
    <td>Email </td>
    <td>Org Name </td>
    <td>Org Url </td>
<tr>

<?php

foreach($producers as $producer){

?>
    <tr>
    <?php echo '<td>'.$producer->first_name. '</td>'; ?>

    <?php echo '<td>'.$producer->last_name. '</td>'; ?>

    <?php echo '<td>'.$producer->user_name. '</td>'; ?>

    <?php echo '<td>'.$producer->email_address. '</td>'; ?>

    <?php echo '<td>'.$producer->org_name. '</td>'; ?>

    <?php echo '<td>'.$producer->organization_url. '</td>'; ?>
    </tr>

<?php
}
?>


</table>
