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
    </tr>

<?php
}
?>


</table>
