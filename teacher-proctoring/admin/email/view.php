<?php
/* TODO:
* Send an email within x days from test
* Ok so gotta get the date of the test
* And gotta compare it with current day
* And allow admin to change when emails are sent
* Kill me
*/
?>

<html>
<head>
    <link rel="stylesheet" type='text/css' href="style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
</head>

<body>
<h1 style="position:relative">Email Status</h1>
<a href="../index.php">
    <button
        type="submit" id="return_button" name="return_button">Return to Admin Panel
    </button>
</a>
<table id="ts">
    <tr>
        <th>Test ID</th>
        <th>Test Name</th>
        <th>Test Date</th>
        <th>Days Away</th>
        <th>Mail</th>
        <th>Email Sent</th>
    </tr>

    <?php foreach ($upcoming_tests as $test) :
        $test_id = $test['test_id'];
        $test_name = $test['test_name'];
        $test_dt = $test['test_dt'];
        $test_days_away = $test['difference'];
        $test_sent = $test['reminder_sent_dt'];
        ?>


        <tr>
            <td> <?php echo $test_id; ?> </td>
            <td><a class="info" style="float: left; position: relative; color: #555555; title='Recipients'"
                   onclick="popup('#B<?php echo $test_id ?>,#P<?php echo $test_id ?>')">✚&nbsp;&nbsp;</a> <?php echo $test_name; ?>
                <div class="popup-bg" id="B<?php echo $test_id ?>" style="display: none;
  opacity: 0.7;
  background: #000;
  width: 100%;
  height: 100%;
  z-index: 10;
  top: 0;
  left: 0;
  position: fixed;">
                </div>
                <div class="popup" id="P<?php echo $test_id ?>">
                    <div class="entpop">
                        <div class="close">
                            <div class="x"
                            "=""><a href="#"
                                    style="color:#f0c30f; text-decoration: none; float: right; text-align: right;"
                                    onclick="cpopup('#B<?php echo $test_id ?>,#P<?php echo $test_id ?>')">✖</a>
                            <div class="presname" style="'text-align: left;"><?php echo $test_name ?></div>
                        </div>
                    </div>
                    <div class="popup-c">
                        <table id="ts">
                            <tr>
                                <th>Last</th>
                                <th>First</th>
                                <th>Time</th>
                                <th>Email</th>
                            </tr>
                            <?php
                            $upcoming_teachers = list_upcoming_teacher_emails($test_id);
                            foreach ($upcoming_teachers as $teacher) :
                                $teacher_first_name = $teacher['usr_first_name'];
                                $teacher_last_name = $teacher['usr_last_name'];
                                $teacher_email = $teacher['user_email'];
                                $teacher_time = $teacher['test_time_desc']; ?>
                                <tr>
                                    <td> <?php echo $teacher_last_name; ?> </td>
                                    <td> <?php echo $teacher_first_name; ?> </td>
                                    <td> <?php echo $teacher_time; ?> </td>
                                    <td> <?php echo $teacher_email; ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                </div></td>
            <td> <?php echo $test_dt; ?> </td>
            <td> <?php echo $test_days_away; ?> </td>
            <td>
                <a href="index.php?action=<?php if ($test_sent == null) {
                    echo 'send_email';
                } else {
                    echo 'list_upcoming_tests';
                }; ?>&test_id=<?php echo $test_id; ?>&test_name=<?php echo $test_name; ?>&test_dt=<?php echo $test_dt; ?>&test_sent=<?php echo $test_sent; ?>"><i
                        class="fa fa-envelope"
                        aria-hidden="true"
                        title="Send Email"
                        style="cursor:pointer"></i></a>
            </td>
            <td> <?php if ($test_sent == null) {
                    echo '<i class="fa fa-times"
                        aria-hidden="true"></i>';
                } else {
                    echo '<i class="fa fa-check"
                        aria-hidden="true"></i>';
                }; ?></td>

        </tr>

    <?php endforeach; ?>

</table>

<center><a href="index.php?action=send_email_all" class="email-all"><i
            class="fa fa-envelope"
            aria-hidden="true"
            title="Send All Emails"
            style="cursor:pointer text-align: center;"></i>Mail All</a></center>
<script type="text/javascript" src="../../js/popup.js"></script>
<script type="text/javascript" src="../../js/cpopup.js"></script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../../js/jquery.plusanchor.min.js"></script>
</body>
</html>

