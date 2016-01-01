<html>
    <head>
        <title>Career Day - Home</title>
    </head>
    <body>
        < border="1">
            <?php for($i = 1; $i <= 4; $i++) {?>
                <tr>
                    <td>Session <?php echo $i?></td>
                    <td><?php
                        $ses = get_session_times_by_id($i);
                        echo ($ses['ses_start']);
                        ?> - <?php
                        echo ($ses['ses_end']);
                        ?></td>
                    <?php $mentor = get_presentation_by_user($user['usr_id'], $i)?>
                    <td><?php if ($mentor == NULL) { ?>
                            Unregistered
                        <?php } else { ?>
                            Rm. <?php echo $mentor['pres_room']?> -
                            <?php echo $mentor['mentor_first_name']?>
                            <?php echo $mentor['mentor_last_name']?>;
                            <?php echo $mentor['mentor_position']?>;
                            <?php echo $mentor['mentor_company']?>
                        <?php } ?></td>
                    <td>
                        <?php if ($current_date < $start_date || $current_date > $end_date) { ?>
                            Locked
                        <?php } else if ($mentor == NULL) { ?>
                            <a href="index.php?session=<?php echo $i?>&action=register">Register</a>
                        <?php } else { ?>
                            <a href="index.php?session=<?php echo $i?>&action=change">Change</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </>
    </body>
</html>