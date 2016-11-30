<html>
<head>
    <link rel="stylesheet" type='text/css' href="styles.css<?php echo(getVersionString()); ?>">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
</head>

<body>

<div id="content">
    <h1 style="position:relative">Proctoring Status</h1>
    <a href="../index.php">
        <button
            type="submit" id="return_button" name="return_button">Return to Admin Panel
        </button>
    </a>

    <table id="ts">
        <tr>

            <th><a href="index.php?action=<?php echo $action ?>&sort=1&order=<?php if ($sort_order == 1 && $sort_by == 1) { echo 2; } else { echo 1; } ?>">Last <?php if($sort_order == 1 && $sort_by == 1) { echo '&#9650;'; } else { echo '&#9660;';}?></a></th>
            <th><a href="index.php?action=<?php echo $action ?>&sort=2&order=<?php if ($sort_order == 1 && $sort_by == 2) { echo 2; } else { echo 1; } ?>">First <?php if($sort_order == 1 && $sort_by == 2) { echo '&#9650;'; } else { echo '&#9660;';}?></a></th>
            <th><a href="index.php?action=<?php echo $action ?>&sort=3&order=<?php if ($sort_order == 1 && $sort_by == 3) { echo 2; } else { echo 1; } ?>">Hours <?php if($sort_order == 1 && $sort_by == 3) { echo '&#9650;'; } else { echo '&#9660;';}?></a></th>
        </tr>
        <?php foreach ($teacher_status_list as $teacher) :
        $teacher_last_name = $teacher['usrLast'];
        $teacher_first_name = $teacher['usrFirst'];
        $teacher_hours = $teacher['usrHours'];
        $teacher_id = $teacher['usr_id'];
        ?>

        <tr>
            <td> <?php echo $teacher_last_name; ?> </td>
            <td> <?php echo $teacher_first_name; ?> </td>
            <td><a class="info" style="float: left; position: relative; color: #555555;"
                   onclick="popup('#B<?php echo $teacher_id ?>,#P<?php echo $teacher_id ?>')">✚&nbsp;&nbsp;</a> <?php echo $teacher_hours; ?>
                <div class="popup-bg" id="B<?php echo $teacher_id ?>" style="display: none;
  opacity: 0.7;
  background: #000;
  width: 100%;
  height: 100%;
  z-index: 10;
  top: 0;
  left: 0;
  position: fixed;">

                </div>
                <div class="popup" id="P<?php echo $teacher_id ?>">
                    <div class="entpop">
                        <div class="close">
                            <div class="x"
                            "=""><a href="#"
                                    style="color:#f0c30f; text-decoration: none; float: right; text-align: right;"
                                    onclick="cpopup('#B<?php echo $teacher_id ?>,#P<?php echo $teacher_id ?>')">✖</a>
                            <div class="presname" style="'text-align: left;"><?php echo $teacher_last_name ?>
                                , <?php echo $teacher_first_name ?></div>

                        </div>

                    </div>
                    <div class="popup-c">
                        <table id="ts">
                            <tr>
                                <th>Test Name</th>
                                <th>Test Date</th>
                            </tr>
                            <?php
                            $teacher_selected_list = list_teacher_selected_tests($teacher_id);
                            foreach ($teacher_selected_list as $test) :
                                $test_name = $test['test_name'];
                                $test_date = $test['test_dt']; ?>
                                <tr>
                                    <td> <?php echo $test_name; ?> </td>
                                    <td> <?php echo $test_date; ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
</div>
</td>
</tr>

<?php endforeach; ?>

</table>


</div>

<script type="text/javascript" src="../../js/popup.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/cpopup.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/jquery.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/jquery.easing.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/jquery.plusanchor.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });
</script>

</body>
</html>