<link rel="stylesheet" type="text/css" href="../css/mentor_list.css">

<h1>Modify Mentor</h1>
    <div id="mentor_add">

        <BR>

        <form action="." method="post">
            <input type="hidden" name="action" value="modify_mentor">
            <input type="hidden" name="mentor_id" value="<?php echo htmlspecialchars($mentor_id);?>">

            <label>First Name:</label>
            <input title = "" type="text" style="width: 12em; display: inline-block;" name="mentor_last_name" value="<?php echo htmlspecialchars($mentor_last_name);?>" required>
            <br>

            <label style="">Last Name:</label>
            <input title = "" type="text" style="width: 12em; display: inline-block;" name="mentor_first_name" value="<?php echo htmlspecialchars($mentor_first_name);?>" required>
            <br>

            <label>Field</label>
            <input title = "" type="text"  style="width: 12em; display: inline-block;" name="mentor_field" value="<?php echo htmlspecialchars($mentor_field);?>" required>
            <br>
            <label>Company</label>
            <input title = "" type="text" style="width: 12em; display: inline-block;" name="mentor_company" value="<?php echo htmlspecialchars($mentor_company);?>" required><BR>
            <br>
            <label>Position</label>
            <input title = "" type="text" name="mentor_position" value="<?php echo htmlspecialchars($mentor_position);?>" ><BR>
            <label>Profile</label>
            <input title = "" type="text" name="mentor_profile" value="<?php echo htmlspecialchars($mentor_profile);?>" ><BR>

            <label>Keywords</label>
            <input title = "" type="text" name="mentor_keywords" value="<?php echo htmlspecialchars($mentor_keywords);?>" ><BR>

            <label>Room</label>
            <input title = "" type="number" name="pres_room" value="<?php echo htmlspecialchars($pres_room);?>" required><BR>

            <label>Host Teacher</label>
            <input title = "" type="text" name="pres_host_teacher" value="<?php echo htmlspecialchars($pres_host_teacher);?>" required><BR>

            <label>Max Capacity</label>
            <input title = "" type="number" name="pres_max_capacity" value="<?php echo htmlspecialchars($pres_max_capacity);?>" required><BR>


            <label>&nbsp;</label>
            <input type="submit" name="choice" value="Add">

            <button><a href="index.php?action=list_mentors" style="text-decoration: none;" >Cancel</a></button>

        </form>
    </div>
