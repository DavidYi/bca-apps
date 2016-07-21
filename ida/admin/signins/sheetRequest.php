<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
?>
<html>
<head>
    <title>Generate Sign in PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../signins.css">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input[type="radio"]').click(function () {
                if ($(this).attr("value") == "session-signins") {
                    $(".mentor").show();
                    $(".session").show();
                    $("input[name='action']").val('generate-session-signins')
                }
                if ($(this).attr("value") == "mentor-signins") {
                    $(".mentor").show();
                    $(".session").hide();
                    $("input[name='action']").val('generate-mentor-signins')
                }
                if ($(this).attr("value") == "room-signs") {
                    $(".mentor").hide();
                    $(".session").hide();
                    $("input[name='action']").val('generate-room-signs')
                }
            });
        });
    </script>
</head>

<a href="../index.php" class="back">
    <button>Back</button>
</a>

<body>

<form action="." method="post">

    <div class="container">
        <ul>
            <li>
                <input type="radio" name="choice" value="session-signins" class="choice" id="sc">
                <label class="title" for="sc">Session Sign in </label>

                <div class="check">
                    <div class="inside"></div>
                </div>
            </li>

            <li>
                <input type="radio" name="choice" value="mentor-signins" class="choice" id="mc">
                <label class="title" for="mc">Mentor Check In </label>

                <div class="check">
                    <div class="inside"></div>
                </div>
            </li>

            <li>
                <input type="radio" name="choice" value="room-signs" class="choice" id="rc">
                <label class="title" for="rc">Room Signs </label>

                <div class="check">
                    <div class="inside"></div>
                </div>
            </li>
        </ul>
    </div>


    <div class="mentor select">
        <br>
        <label>Mentor:</label>
        <select name="mentor" class="red">
            <option value="All" selected="selected">All Mentors</option>
            <?php foreach ($mentors as $mentor) :
                if (($mentor['mentor_id'] == $mentor_id)) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                ?>
                <option value="<?php echo $mentor['mentor_id']; ?>"<?php
                echo $selected ?>>
                    <?php echo htmlspecialchars($mentor['mentor_last_name']) ?>, <?php
                    echo htmlspecialchars($mentor['mentor_first_name']); ?> (<?php echo
                    htmlspecialchars($mentor['mentor_company']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="session select">
        <br>
        <label>Session:</label>
        <select name="session" class="purple">
            <option value="All" selected="selected">All Sessions</option>
            <?php foreach ($sessions as $session) :
                if ($session['ses_id'] == $session_id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                ?>
                <option value="<?php echo $session['ses_id']; ?>"<?php
                echo $selected ?>>
                    <?php echo htmlspecialchars($session['ses_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>
    <input type="hidden" name="action" value="<?php echo 'generate-' . $_POST['choice'] ?>">
    <input type="submit" value="Generate" class="submit">

</form>
</body>
</html>
