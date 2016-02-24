<html>
    <title>
        Admin Panel - Rooms
    </title>

    <body>
        <table>
            <tr>
                <th>Number</th>
                <th>Capacity</th>
            </tr>
            <?php foreach ($rm_list as $rm) { ?>
                <tr>
                    <td><?php echo $rm['rm_nbr'] ?></td>
                    <td><?php echo $rm['rm_cap'] ?></td>
                    <td><a href="index.php?action=edit&id=<?php echo $rm['rm_id'] ?>"> Edit </a></td>
                    <td><a href="index.php?action=delete&id=<?php echo $rm['rm_id']?>"> Delete </a></td>
                </tr>
            <?php } ?>
        </table>

        <a href="index.php?action=add">Add new room</a>

    </body>
</html>