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
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
