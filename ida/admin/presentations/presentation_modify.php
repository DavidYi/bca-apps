<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Presentation</title>

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
    <h1 class="title">Edit Presentation</h1>
</header>

<body>
<div id="mentor_add">

    <?php echo $error_msg ?>
    <BR>


    <form action="." method="post">
        <input type="hidden" name="action" value="modify_presentation">

        <label>Workshop</label>
        <select class="center" name="workshop">
            <?php foreach ($workshopList as $workshop) {?>
                <option value=<?php echo($workshop['wkshp_id']); ?>><?php echo($workshop['wkshp_nme']); ?></option>
            <?php } ?>
        </select><br>

        <label>Presenters</label>
        <input title="" type="text" name="presenters" value="<?php echo htmlspecialchars($presenter_names); ?>"
               placeholder="Presenter Names" required><BR>

        <label>Organization</label>
        <input title="" type="text" name="organization" value="<?php echo htmlspecialchars($org_name); ?>"
               placeholder="Affiliation" required><BR>

        <label>Session</label>
        <select class="center" name="session">
            <option value="1">1</option>
            <option value="2">2</option>
        </select><br>

        <label>Room</label>
        <select class="center" name="room">
            <?php foreach ($roomList as $room) {?>
                <option value=<?php echo($room['rm_id']); ?>><?php echo($room['rm_nbr']); ?></option>
            <?php } ?>
        </select><br>

        <label>Max Capacity</label>
        <input title="" type="number" name="pres_max_capacity" value="<?php echo htmlspecialchars($pres_max_seats); ?>"
               placeholder="Seats" required><BR>

        <div class="button-container">
            <button class="add" name="choice" type="submit" value="Modify">Modify Presentation</button>
            <button class="add" name="choice" type="submit" value="Back">Go Back</button>
        </div>
    </form>
</div>
</body>
</html>