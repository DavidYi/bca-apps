<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modify Room</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../ss/main.css" rel="stylesheet">

    <style>
        body {
            font-size: 1.66em;
        }
    </style>

</head>
<header>
    <h1 class="title">Admin: Room</h1>
</header>

<body>
<div id="mentor_add">

    <BR>


    <form action="." method="post">
        <input type="hidden" name="action" value="modify_room">
        <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
        <label>Room</label>
        <input type="text" placeholder="Room" name="room_nbr" value="<?php echo htmlspecialchars($room_nbr);?>" autofocus required>
        <div class="button-container">
            <button style="cursor: pointer" class="add" name="choice" type="submit" value="Modify">Submit</button>
            <button style="cursor: pointer" class="add" name="choice" type="submit" value="Back">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>