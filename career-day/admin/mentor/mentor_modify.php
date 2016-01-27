<link rel="stylesheet" type="text/css" href="../css/mentor_list.css">

<h1>Modify Mentor</h1>
    <div id="mentor_add">

        <BR>

        <form action="." method="post">
            <input type="hidden" name="action" value="modify_mentor">
            <input type="hidden" name="mentor_id" value="<?php echo htmlspecialchars($mentor_id);?>">

            <label>First Name:</label>
            <input type="text" style="width: 12em; display: inline-block;" name="mentor_last_name" value="<?php echo htmlspecialchars($mentor_last_name);?>" required>
            <br>

            <label style="">Last Name:</label>
            <input type="text" style="width: 12em; display: inline-block;" name="mentor_first_name" value="<?php echo htmlspecialchars($mentor_first_name);?>" required>
            <br>

            <label>Field</label>
            <input type="text"  style="width: 12em; display: inline-block;" name="mentor_field" value="<?php echo htmlspecialchars($mentor_field);?>" required>
            <br>
            <label>Company</label>
            <input type="text" style="width: 12em; display: inline-block;" name="mentor_company" value="<?php echo htmlspecialchars($mentor_company);?>" required><BR>
            <br>
            <label>Position</label>
            <input type="text" name="mentor_position" value="<?php echo htmlspecialchars($mentor_position);?>" ><BR>
            <label>Profile</label>
            <input type="text" name="mentor_profile" value="<?php echo htmlspecialchars($mentor_profile);?>" ><BR>

            <label>Keywords</label>
            <input type="text" name="mentor_keywords" value="<?php echo htmlspecialchars($mentor_keywords);?>" ><BR>

            <label>Email</label>
            <input type="email" name="mentor_email" value="<?php echo htmlspecialchars($mentor_email);?>" ><BR>

            <label>Cell Number</label>
            <input type="text" name="mentor_cell_nbr" value="<?php echo htmlspecialchars($mentor_cell_nbr);?>" ><BR>

            <label>Phone Number</label>
            <input type="text" name="mentor_phone_nbr" value="<?php echo htmlspecialchars($mentor_phone_nbr);?>" ><BR>

            <label>Address</label>
            <input type="text" name="mentor_adress" value="<?php echo htmlspecialchars($mentor_address);?>" ><BR>

            <label>Source</label>
            <input type="text" name="mentor_source" value="<?php echo htmlspecialchars($mentor_source);?>" ><BR>

            <label>Notes</label>
            <input type="text" name="mentor_notes" value="<?php echo htmlspecialchars($mentor_notes);?>" ><BR>

            <label>Room</label>
            <input type="number" name="pres_room" value="<?php echo htmlspecialchars($pres_room);?>" required><BR>

            <label>Host Teacher</label>
            <input type="text" name="pres_host_teacher" value="<?php echo htmlspecialchars($pres_host_teacher);?>" required><BR>

            <label>Max Capacity</label>
            <input type="number" name="pres_max_capacity" value="<?php echo htmlspecialchars($pres_max_capacity);?>" required><BR>


            <label>&nbsp;</label>
            <input type="submit" name="choice" value="Add">

            <button><a href="index.php?action=list_mentors" style="text-decoration: none;" >Cancel</a></button>

        </form>
    </div>
