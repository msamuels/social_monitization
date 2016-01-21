<H1>Supporters</H1>

<table  border=1>
<tr>
    <td>Username </td>
    <td>Email </td>
    <td>Interests</td>
    <td># of Facebook Followers </td>
    <td>FB screenshot </td>
    <td>Account Approved </td>
    <td>#Campaings Supported </td>
    <td>Mailing List</td>
<tr>

<?php

foreach($supporters as $supporter){

?>
    <tr>
    <?php echo '<td>'.$supporter->user_name. '</td>'; ?>

    <?php echo '<td>'.$supporter->email_address. '</td>'; ?>

    <?php echo '<td>'.$supporter->interests. '</td>'; ?>

    <?php echo '<td>--</td>'; ?>

    <?php echo '<td>--</td>'; ?>

    <?php echo '<td>'.$supporter->approved. '</td>'; ?>

    <?php echo '<td>--</td>'; ?>

    <?php echo '<td>--</td>'; ?>
    </tr>

<?php
}
?>


</table>
