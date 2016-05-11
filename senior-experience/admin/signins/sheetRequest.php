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
                if ($(this).attr("value") == "s") {
                    $("input[name='action']").val('generates')
                }
                if ($(this).attr("value") == "r") {
                    $("input[name='action']").val('generater')
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
                <input type="radio" name="choice" value="s" class="choice" id="sc">
                <label class="title" for="sc">Session Sign in </label>

                <div class="check">
                    <div class="inside"></div>
                </div>
            </li>

            <li>
                <input type="radio" name="choice" value="r" class="choice" id="rc">
                <label class="title" for="rc">Room Signs </label>

                <div class="check">
                    <div class="inside"></div>
                </div>
            </li>
        </ul>
    </div>

    <br>
    <input type="hidden" name="action" value="<?php echo 'generate' . $_POST['choice'] ?>">
    <input type="submit" value="Generate" class="submit">

</form>
</body>
</html>
