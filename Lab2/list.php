<?php
$data = file("data.txt"); // read all lines
?>

<h2>All Users</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Actions</th>
</tr>
<?php   
foreach($data as $index => $line){
    $row = explode(",", trim($line));
?>
<tr>
    <td><?= $index ?></td>
    <td><?= $row[0] ?></td>
    <td><?= $row[1] ?></td>
    <td>
        <a href="view.php?id=<?= $index ?>">View</a> |
        <a href="delete.php?id=<?= $index ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>