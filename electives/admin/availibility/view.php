/**
 * Created by PhpStorm.
 * User: shawnrobin
 * Date: 7/27/16
 * Time: 11:12 AM
 */
<html>
<head>
    <title>Elective Availibility</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <table>
        <thead>
            <th>
                Teacher
            </th>
            <th>
                Free Mods
            </th>
        </thead>
        <?php foreach ($free_mods as $teacher) :
            $firstName = $teacher['usr_first_name'];
            $lastName = $teacher['usr_last_name'];
            $freeMods = $teacher['mods_available'];
            ?>

            <tr>
                <td><?php echo $firstName ?>,<?php echo $lastName ?></td>
                <td><?php echo $freeMods ?></td>
            </tr>

        <?php endforeach; ?>
    </table>

</body>
</html>