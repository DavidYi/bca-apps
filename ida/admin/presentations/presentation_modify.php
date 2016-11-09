<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Presentation</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Styles -->
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="styles2.css" rel="stylesheet">
    </head>

    <body>
        <form action="." method="post">
            <input type="hidden" name="action" value="modify_presentation">
            <input type="hidden" name="pres_id" value="<?php echo($pres_id); ?>">
s
            <div id="box">
                <div id="wrapper">
                    <div id ="columns">
                        <h1 class="title">Edit Presentation</h1>

                        <label>Workshop</label>
                        <select class="center" name="workshop">
                            <?php foreach ($workshopList as $workshop) { ?>
                                <option
                                    value=<?php echo($workshop['wkshp_id']); ?> <?php if ($workshop['wkshp_id'] == $presentation['wkshp_id']) { ?>selected="selected"<?php } ?>><?php echo($workshop['wkshp_nme']); ?></option>
                            <?php } ?>
                        </select><br>
                        
                        <input title="" type="text" name="presenters" value="<?php echo htmlspecialchars($presenter_names); ?>"
                               placeholder="Presenter Names" required><BR>

                        <input title="" type="text" name="organization" value="<?php echo htmlspecialchars($org_name); ?>"
                               placeholder="Organization" required><BR>

                        <input title="" type="number" name="pres_max_capacity" value="<?php echo htmlspecialchars($pres_max_seats); ?>"
                               placeholder="Max Capacity"><BR>

                        <label>Auto-Enroll</label>
                        <select class="center" name="pres_permit_auto_enroll">
                            <option value="1" <?php if ($pres_permit_auto_enroll == 1){ ?>selected="selected"<?php } ?>>Yes</option>
                            <option value="0" <?php if ($pres_permit_auto_enroll == 0){ ?>selected="selected"<?php } ?>>No</option>
                        </select>
                        <BR>

                        <div id="combo-row">
                            <div id="session">
                                <label>Session</label>
                                <select class="center" name="session">
                                    <option value="1" <?php if ($presentation['ses_id'] == 1){ ?>selected="selected"<?php } ?>>1</option>
                                    <option value="2" <?php if ($presentation['ses_id'] == 2){ ?>selected="selected"<?php } ?>>2</option>
                                </select>
                            </div>

                            <div id="room">
                                <label>Room</label>
                                <select class="center" name="room">
                                    <?php foreach ($roomList as $room) { ?>
                                        <option
                                            value=<?php echo($room['rm_id']); ?> <?php if ($presentation['rm_id'] == $room['rm_id']){ ?>selected="selected"<?php } ?>><?php echo($room['rm_nbr']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div id="button-div">
                            <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Modify">Submit</button>
                            <button style="cursor: pointer" class="submit cancel" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
                        </div>


                    </div>
                </div>
        </form>
    </body>
</html>