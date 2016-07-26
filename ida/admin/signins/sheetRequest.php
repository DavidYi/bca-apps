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
    <link rel="stylesheet" type="text/css" href="../../../shared/ss/main.css">
    <link rel="stylesheet" type="text/css" href="../signins.css"
    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input[type="radio"]').click(function () {
                if ($(this).attr("value") == "session-signins") {
                    $(".mentor").show();
                    $(".session").show();
                    $("input[name='action']").val('generate-session-signins')
                }
                if ($(this).attr("value") == "presenter-signin") {
                    $(".mentor").show();
                    $(".session").hide();
                    $("input[name='action']").val('generate-presenter-signin')
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

<body>



    <header><h1 class="title"><h2>Admin Generator Tools</h2></h1>
        <div id="logout"><h2><a href="../index.php?action=logout">Log Out</a></h2></div>
    </header>
    <form action="." method="post">
    <br>
    <table>
        <tr>
            <td>
                <a href="./index.php?action=generate-session-signins" target="_blank">
                    <div class="feature">
                        <h2>Session Sign In Sheets</h2>
                        <p>Generates sign in sheets for each presentation.</p>
                    </div>
                </a>
            </td>
            <td>
                <a href="./index.php?action=generate-presenter-signin" target="_blank">
                    <div class="feature">
                        <h2>Presenter Sign In Sheet</h2>
                        <p>Generates sign in sheet for visitors.</p>
                    </div>
                </a>
            </td>
            <td>
                <a href="./index.php?action=generate-room-signs" target="_blank">
                    <div class="feature">
                        <h2>Room Signs</h2>
                        <p>Generates the room signs.</p>
                    </div>
                </a>
            </td>
            </tr>
        </table>
        </br>
        <a href="../index.php" class="back">
            Back
        </a>
    <!--<div class="feature">
        <a href="./index.php?action=generate-session-signins" target="_blank"><h2>Session Sign In Sheets</h2></a>
        <h4>Generates the sign in sheets for each presentation.</h4></div>
    <div class="feature">
        <a href="./index.php?action=generate-presenter-signin" target="_blank"><h2>Presenter Sign In Sheet</h2></a>
        <h4>Generates sign in sheet for visitors.</h4></div>
    <div class="feature">
        <a href="./index.php?action=generate-room-signs" target="_blank"><h2>Room Signs</h2></a>
        <h4>Generates the room signs</h4></div>
    <div class="feature">
        <a href="../index.php"><h2>Back to Menu</h2></a>
        <h4></h4></div>
    <a href="../index.php" class="back">
        <button>Back</button>
    </a>
    <div class="feature">
        <a href="../../index.php?action=logout"><h2>Log Out</h2></a>
        <h4></h4></div>-->
    <!--<div class="container">
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
    </div>-->


    <!--<div class="mentor select">
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
    <input type="submit" value="Generate" class="submit">-->

</form>
</body>
</html>
