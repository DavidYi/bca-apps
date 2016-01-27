<html>
    <head>

    </head>

    <body>
 <h1>Add Mentor</h1>
    <div id="mentor_add">

        <?php echo $error_msg ?>
        <BR>

        <form action="." method="post">
            <input type="hidden" name="action" value="add_mentor">

            <label>First Name:</label>
            <input title="" type="text" name="mentor_last_name" value="<?php echo htmlspecialchars($mentor_last_name);?>" required><BR>

            <label>Last Name:</label>
            <input title="" type="text" name="mentor_first_name" value="<?php echo htmlspecialchars($mentor_first_name);?>" required><BR>

            <label>Mentor Company:</label>
            <input title="" type="text" name="mentor_company" value="<?php echo htmlspecialchars($mentor_company);?>" required><BR>

            <label>Mentor Field:</label>
            <input  title="" type="text" name="mentor_field" value="<?php echo htmlspecialchars($mentor_field);?>" maxlength="16" required><BR>

            <label>Mentor_Position:</label>
            <input  title="" type="text" name="mentor_position" value="<?php echo htmlspecialchars($mentor_position);?>"><BR>

            <label>Mentor Profile:</label>
            <input title=""  type="text" name="mentor_profile" value="<?php echo htmlspecialchars($mentor_profile);?>"><BR>

            <label>Mentor Keywords:</label>
            <input  title="" type="text" name="mentor_keywords" value="<?php echo htmlspecialchars($mentor_keywords);?>" ><BR>

            <label>Mentor Email:</label>
            <input  title="" type="text" name="mentor_email" value="<?php echo htmlspecialchars($mentor_email);?>"><BR>

            <label>Mentor Cell Number:</label>
            <input  title="" type="text" name="mentor_cell_nbr" value="<?php echo htmlspecialchars($mentor_cell_nbr);?>"><BR>

            <label>Mentor Phone Number:</label>
            <input title="" type="text" name="mentor_phone_nbr" value="<?php echo htmlspecialchars($mentor_phone_nbr);?>"><BR>

            <label>Mentor Address:</label>
            <input  title="" type="text" name="mentor_adress" value="<?php echo htmlspecialchars($mentor_address);?>"><BR>

            <label>Mentor Source:</label>
            <input  title="" type="text" name="mentor_source" value="<?php echo htmlspecialchars($mentor_source);?>"><BR>

            <label>Mentor Notes:</label>
            <input title=""  type="text" name="mentor_notes" value="<?php echo htmlspecialchars($mentor_notes);?>"><BR>

            <label>Presentation Room:</label>
            <input  title="" type="text" name="pres_room" value="<?php echo htmlspecialchars($pres_room);?>" required><BR>

            <label>Host teacher:</label>
            <input  title="" type="text" name="pres_host_teacher" value="<?php echo htmlspecialchars($pres_host_teacher);?>" required><BR>

            <label>Max Capacity: </label>
            <input title="" type="text" name="pres_max_capacity" value="<?php echo htmlspecialchars($pres_max_capacity);?>" required><BR>

            <input type="submit" name="choice" value="Add">
            <button><a href="index.php?action=list_mentors" style="text-decoration: none;" >Cancel</a></button>
        </form>
    </div>
    </body>
</html>