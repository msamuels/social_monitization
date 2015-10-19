<table>
<tr>
    <td>First Name </td>
    <td>First Name </td>
    <td>First Name </td>
    <td>First Name </td>
    <td>First Name </td>
    <td>First Name </td>
<tr>

<?php

foreach($producers as $producer){

?>
    <tr>
    echo '<td>'.$producer->first_name. '</td>';
    </tr>

<?php
}
?>


</table>
