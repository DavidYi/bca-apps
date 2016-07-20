<html>
<head>
    <link rel="stylesheet" type='text/css' href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
</head>

<body>

<div id="content">

    <table id="ts">
        <tr>
            <th>Last</th>
            <th>First</th>
            <th>Hours</th>
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

<script type="text/javascript" src="../../js/popup.js"></script>
<script type="text/javascript" src="../../js/cpopup.js"></script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });

    /*
     function postRegister(postObject) {
     $.post(
     "/index.php",
     {
     "pres_id": postObject
     },
     function (data) {
     data = $.parseJSON(data);
     },
     "json"
     );
     });
     */
</script>

</body>
</html>