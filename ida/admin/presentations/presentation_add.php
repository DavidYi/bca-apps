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

                        <table>
                            <tr>
                                <td nowrap>
                                    <label>Workshop</label>
                                </td>
                                <td class="dropdown">
                                    <select name="workshop">
                                        <?php foreach ($workshopList as $workshop) { ?>
                                            <option value=<?php echo($workshop['wkshp_id']); ?>><?php echo($workshop['wkshp_nme']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td nowrap>
                                    <label>Presenter Names</label>
                                </td>
                                <td>
                                    <input title="" type="text" name="presenters" value="" required>
                                </td>
                            </tr>
                            <tr>
                                <td nowrap>
                                    <label>Organization</label>
                                </td>
                                <td>
                                    <input title="" type="text" name="organization" required>
                                </td>
                            </tr>
                            <tr>
                                <td nowrap>
                                    <label>Max Capacity</label>
                                </td>
                                <td>
                                    <input title="" type="number" min="1" name="pres_max_capacity" value="" required>
                                </td>
                            </tr>
                        </table>
                        <table id="combo-table">
                            <tr id="combo-row">
                                <td id="session-td" nowrap>
                                    <label id="session-label">Session</label>
                                </td>
                                <td class="dropdown">
                                    <select name="session" class="small">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </td>
                                <td nowrap>
                                    <label id="room-label">Room</label>
                                </td>
                                <td class="dropdown">
                                    <select name="room" class="small">
                                        <?php foreach ($roomList as $room) { ?>
                                            <option value=<?php echo($room['rm_id']); ?>><?php echo($room['rm_nbr']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td nowrap>
                                    <label id="auto-label">Auto-Enroll</label>
                                </td>
                                <td class="dropdown">
                                    <select class="small" name="pres_permit_auto_enroll">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <div id="button-div">
                            <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Add">Submit</button>
                            <button style="cursor: pointer" class="submit b" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
                        </div>

                    </div>
                </div>
        </form>
    </body>
</html>