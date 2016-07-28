<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="mentor_modify.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="index.php?action=modify_mentor" method="post">
    <input type="hidden" name="action" value="modify_mentor">
    <div id="box">
        <div id="fixed_div">
            <button class="submit s" type="submit" name="choice" value="Modify">Update</button>
            <button class="submit back" id="delButton" type="submit"
                    name="choice" value="Delete"
                    onclick="return confirm('Are you sure you want to delete this mentor?');"
                    formnovalidate>Delete</button>
            <p class="title">Editing Mentor: <?php echo
                htmlspecialchars($mentor_first_name . ', ' . $mentor_last_name); ?></p>
            <button style="margin-left:5%" class="submit back"
                    type="submit" name="choice" value="Back" formnovalidate>Back</button>
            <div id="header_row">
                <label>
                    <span id="name_header"><strong>Details</strong></span>
                </label>
            </div>
        </div>

        <div id="teacher_div">
            <input type="hidden" name="mentor_id" value="<?php echo htmlspecialchars($mentor_id); ?>">
            <div class="row">
                <label>
                    <span class="teacher_name">First Name</span>
                </label>
                <input type="text" placeholder="First Name" name="mentor_first_name"
                       value="<?php echo htmlspecialchars($mentor_first_name); ?>" autofocus required>
            </div>
            <div class="row odd">
                <label>
                    <span class="teacher_name">Last Name</span>
                </label>
                <input type="text" placeholder="Last Name" name="mentor_last_name"
                       value="<?php echo htmlspecialchars($mentor_last_name); ?>" required>
            </div>
            <div class="row">
                <label>
                    <span class="teacher_name">Suffix</span>
                </label>
                <input type="text" placeholder="Suffix" name="mentor_suffix"
                       value="<?php echo htmlspecialchars($mentor_suffix); ?>">
            </div>
            <div class="row odd">
                <label>
                    <span class="teacher_name">Field</span>
                </label>
                <input type="text" placeholder="Field" name="mentor_field"
                       value="<?php echo htmlspecialchars($mentor_field); ?>" required>
            </div>
            <div class="row">
                <label>
                    <span class="teacher_name">Company</span>
                </label>
                <input type="text" placeholder="Company" name="mentor_company"
                       value="<?php echo htmlspecialchars($mentor_company); ?>" required>
            </div>
            <div class="row odd">
                <label>
                    <span class="teacher_name">Position</span>
                </label>
                <input type="text" placeholder="Position" name="mentor_position"
                       value="<?php echo htmlspecialchars($mentor_position); ?>" required>
            </div>
            <div class="row">
                <label>
                    <span class="teacher_name" style="vertical-align:top;">Profile</span>
                </label>
                <textarea rows="3" cols="100" class = "center" type = "text" name="mentor_profile"
                          value="<?php echo htmlspecialchars($mentor_profile);?>"
                          placeholder="Profile" required>
                </textarea>
            </div>
            <div class="row odd">
                <label>
                    <span class="teacher_name">Keywords</span>
                </label>
                <input style="margin-left:10%;width:60%" type="text" name="mentor_keywords"
                       value="<?php echo htmlspecialchars($mentor_keywords);?>" placeholder="Keywords">
            </div>
            <div class="row">
                <label>
                    <span class="teacher_name">Presentation Room</span>
                </label>
                <input type="number" name="pres_room"
                       value="<?php echo htmlspecialchars($pres_room); ?>"
                       placeholder="Presentation Room" required>
            </div>
            <div class="row odd">
                <label>
                    <span class="teacher_name">Host Teacher</span>
                </label>
                <input type="text" name="pres_host_teacher"
                       value="<?php echo htmlspecialchars($pres_host_teacher); ?>"
                       placeholder="Host Teacher" required>
            </div>
            <div class="row">
                <label>
                    <span class="teacher_name">Max Capacity</span>
                </label>
                <input type="number" name="pres_max_capacity"
                       value="<?php echo htmlspecialchars($pres_max_capacity); ?>"
                       placeholder="Max Capacity" required>
            </div>
            <div class="row odd">
                <label>
                    <span class="teacher_name">Sessions</span>
                </label>
                <input type="checkbox" name="mentor_session_1" value="1" placeholder="Session 1"
                    <?php echo ($mentor_sessions_check[0] ? 'checked' : '');?>>1
                <input type="checkbox" name="mentor_session_2" value="2" placeholder="Session 2"
                    <?php echo ($mentor_sessions_check[1] ? 'checked' : '');?>>2
                <input type="checkbox" name="mentor_session_3" value="3" placeholder="Session 3"
                    <?php echo ($mentor_sessions_check[2] ? 'checked' : '');?>>3
                <input type="checkbox" name="mentor_session_4" value="4" placeholder="Session 4"
                    <?php echo ($mentor_sessions_check[3] ? 'checked' : '');?>>4
            </div>
        </div>
    </div>
</form>
</body>
</html>
