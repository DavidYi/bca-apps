<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
?>
<html>
<head>
    <title>Generate Sign in PDF</title>
</head>
<body>

<form action="." method="post">
    <input type="hidden" name="action" value="generate">
    <label>Mentor:</label>
    <select name="mentor">
        <option value="All" selected="selected">All Mentors</option>
        <?php foreach ($mentors as $mentor) :
            if (($mentor['mentor_id'] == $mentor_id)) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>
            <option value="<?php echo $mentor['mentor_id']; ?>" selected="<?php
            echo $selected ?>">
                <?php echo htmlspecialchars($mentor['mentor_last_name'])?>, <?php
                echo htmlspecialchars($mentor['mentor_first_name']); ?> (<?php echo
                htmlspecialchars($mentor[mentor_company])?>)
            </option>
        <?php endforeach; ?>
    </select>
    <select name="session">
        <option value="All" selected="selected">All Sessions</option>
        <?php foreach ($sessions as $session) :
            if ($session['ses_id'] == $session_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>
            <option value="<?php echo $session['ses_id']; ?>"<?php
            echo $selected ?>>
                <?php echo htmlspecialchars($session['ses_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    //the following select options are there for now
    <select name="rmNumber">
        <?php foreach ($rmNumbers as $rm) :
            if ($rm == $rmNum) {
                $selected = 'selected';
            } else{
                $selected = '';
            }
            ?>
        <option value="<?php echo $rm; ?>" <?php echo $selected ?>>
            <?php echo htmlspecialchars($rm); ?>
        </option>
        <?php endforeach; ?>
    </select>

    <select name="hostTeacher">
        <?php foreach ($hostTeachers as $hostTeacher) :
            if ($hostTeacher == $hostTeach) {
                $selected = 'selected';
            } else{
                $selected = '';
            }
            ?>
            <option value="<?php echo $hostTeacher; ?>" <?php echo $selected ?>>
                <?php echo htmlspecialchars($hostTeacher); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Generate">\
</form>
</body>
</html>
