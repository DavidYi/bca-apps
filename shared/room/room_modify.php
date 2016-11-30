
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Room</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../../shared/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <link href="../../../shared/room/styles2.css<?php echo(getVersionString()); ?>" rel="stylesheet">

</head>
<body>
<form action="." method="post">
    <input type="hidden" name="action" value="add_room">
    <div id="box">
        <div id="wrapper">
            <div id ="columns">
                <h1 class="title">Modify Room</h1>

                <input type="hidden" name="action" value="modify_room">
                <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
                <label>Room</label>
                <input type="text" placeholder="Room" name="room_nbr" value="<?php echo htmlspecialchars($room_nbr);?>" autofocus required>

                <div id="button-div">
                    <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Modify">Submit</button>
                    <a href="index.php"><button style="cursor: pointer" class="submit b" type="button" name="choice" value="Back" formnovalidate>Cancel</button></a>
                </div>
            </div>
        </div>
</form>
</body>
</html>