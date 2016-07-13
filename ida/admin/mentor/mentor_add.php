<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Mentor</title>

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
    <h1 class="title">New Mentor</h1>
</header>

<body>
<div id="mentor_add">

    <?php echo $error_msg ?>
    <BR>
    

    <form action="." method="post">
        <input type="hidden" name="action" value="add_mentor">

        <label>First Name</label>
        <input title="" type="text" name="mentor_last_name" value="<?php htmlspecialchars($mentor_last_name); ?>"
               placeholder="First Name" required autofocus>

        <label>Last Name</label>
        <input title="" type="text" name="mentor_first_name" value="<?php echo htmlspecialchars($mentor_first_name); ?>"
               placeholder="Last Name" required><BR>

        <label>Company</label>
        <input title="" type="text" name="mentor_company" value="<?php echo htmlspecialchars($mentor_company); ?>"
               placeholder="Mentor Company" required><BR>

        <label>Field</label>
        <input title="" type="text" name="mentor_field" value="<?php echo htmlspecialchars($mentor_field); ?>"
               maxlength="16" placeholder="Mentor Field" required><BR>

        <label>Mentor Position</label>
        <input title="" type="text" name="mentor_position"
               value="<?php echo htmlspecialchars($mentor_position); ?>" placeholder="Mentor Position"><BR>

        <label>Mentor Profile</label>
        <textarea rows="4" cols="50" class = "center" type = "text" name="mentor_profile"
                  value="<?php echo htmlspecialchars($mentor_profile);?>" placeholder="Profile">
            </textarea>

        <label>Mentor Keywords</label>
        <input title="" type="text" name="mentor_keywords"
               value="<?php echo htmlspecialchars($mentor_keywords); ?>" placeholder="Mentor Keywords"><BR>

        <label>Presentation Room</label>
        <input title="" type="text" name="pres_room" value="<?php echo htmlspecialchars($pres_room); ?>"
               placeholder="Presentation Room" required><BR>

        <label>Host Teacher</label>
        <input title="" type="text" name="pres_host_teacher" value="<?php echo htmlspecialchars($pres_host_teacher); ?>"
               placeholder="Host Teacher" required><BR>

        <label>Max Capacity</label>
        <input title="" type="text" name="pres_max_capacity" value="<?php echo htmlspecialchars($pres_max_capacity); ?>"
               placeholder="Max Capacity" required><BR>

        <div class="button-container">
            <button class="add">Add Mentor</button>
        </div>
    </form>
</div>
</body>
</html>