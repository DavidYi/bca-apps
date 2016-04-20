<html>
<title>
    Admin Panel - Fields
</title>

<body>
<table>
    <tr>
        <th style="float: left">Name</th>
    </tr>
    <?php foreach ($field_list as $field) { ?>
        <tr>
            <td><?php echo $field['field_name'] ?></td>
            <td><a href="index.php?action=edit&id=<?php echo $field['field_id'] ?>"> Edit </a></td>
            <td><a href="index.php?action=delete&id=<?php echo $field['field_id']?>"> Delete </a></td>
        </tr>
    <?php } ?>
</table>

<a href="index.php?action=add">Add new field</a>

</body>
</html>