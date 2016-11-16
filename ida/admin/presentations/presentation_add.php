<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Presentation</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Styles -->
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="styles2.css" rel="stylesheet">

    </head>

    <body>
        <form action="." method="post">
            <input type="hidden" name="action" value="add_presentation">

            <div id="box">
                <div id="wrapper">
                    <div id ="columns">
                        <h1 class="title">Add Presentation</h1>

                        <label id="workshop">Workshop</label>
                        <select class="center" name="workshop">
                            <?php foreach ($workshopList as $workshop) { ?>
                                <option value=<?php echo($workshop['wkshp_id']); ?>><?php echo($workshop['wkshp_nme']); ?></option>
                            <?php } ?>
                        </select><br>

                        <label>Presenter Names</label><input title="" type="text" name="presenters" value="" required><BR>

                        <label>Organization</label><input title="" type="text" name="organization" value=""  required><BR>

                        <label>Max Capacity</label><input title="" type="number" name="pres_max_capacity" value=""><BR>

                        <div id="combo-row">
                            <div id="session">
                                <label>Session</label>
                                <select class="center" name="session">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>

                            <div id="room">
                                <label>Room</label>
                                <select class="center" name="room">
                                    <?php foreach ($roomList as $room) { ?>
                                        <option value=<?php echo($room['rm_id']); ?>><?php echo($room['rm_nbr']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div id="button-div">
                            <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Add">Submit</button>
                            <button style="cursor: pointer" class="submit b" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
                        </div>


                    </div>
                </div>
        </form>
    </body>
</html>