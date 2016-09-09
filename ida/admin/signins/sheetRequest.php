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
    <link rel="stylesheet" type="text/css" href="../../../shared/ss/main.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
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
    <div id="wrapper">
        <header>
            <h1 class="title"><h2>Admin Generator Tools</h2></h1>
            <div id="logout"><h2><a style="cursor: pointer" href="../index.php">Back
            </a></h2></div>
            <!--<div id="logout"><h2><a href="../index.php?action=logout">Log Out</a></h2></div>-->
        </header>
        <br>
        <form action="." method="post">
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
        </form>
    </div>

    <!--<a href="../index.php" class="back">
        <button style="cursor: pointer" id="back">Back</button>
    </a>-->
</body>
</html>
