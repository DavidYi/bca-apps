<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin: Mentor</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../admin/ss/main.css" rel="stylesheet">
    <style>
        body {
            font-size: 1.66em;
        }
    </style>
</head>
<body>
<header>
    <h1 class="title">Editing: <?php echo htmlspecialchars($mentor_first_name . ', ' . $mentor_last_name); ?></h1>
</header>
<form action="index.php?action=modify_mentor" method="post">
    <input type="hidden" name="action" value="modify_mentor">
    <input type="hidden" name="mentor_id" value="<?php echo htmlspecialchars($mentor_id); ?>">

    <input type="text" placeholder="First Name" name="mentor_first_name"
           value="<?php echo htmlspecialchars($mentor_first_name); ?>" autofocus required>
    <input type="text" name="mentor_last_name"
           value="<?php echo htmlspecialchars($mentor_last_name); ?>" placeholder="Last Name" required>
    <input type="text" name="mentor_suffix"
           value="<?php echo htmlspecialchars($mentor_suffix); ?>" placeholder="Suffix" required>
    <input type="text" name="mentor_field"
           value="<?php echo htmlspecialchars($mentor_field); ?>" placeholder="Field" required>
    <input type="text" name="mentor_company"
           value="<?php echo htmlspecialchars($mentor_company); ?>" placeholder="Company" required>
    <input type="text" name="mentor_position"
           value="<?php echo htmlspecialchars($mentor_position); ?>" placeholder="Position">
    <input type="text" name="mentor_profile"
           value="<?php echo htmlspecialchars($mentor_profile); ?>" placeholder="Profile">
    <input type="text" name="mentor_keywords"
           value="<?php echo htmlspecialchars($mentor_keywords); ?>" placeholder="Keywords">
    <input type="number" name="pres_room"
           value="<?php echo htmlspecialchars($pres_room); ?>" placeholder="Presentation Room" required>
    <input type="text" name="pres_host_teacher"
           value="<?php echo htmlspecialchars($pres_host_teacher); ?>" placeholder="Host Teacher" required>
    <input type="number" name="pres_max_capacity"
           value="<?php echo htmlspecialchars($pres_max_capacity); ?>" placeholder="Max Capacity" required>

    <div class="button-container">
            <button class="add" name="choice" type="submit" value="Modify">Save Changes</button>
    </div>
</form>
</body>
</html>