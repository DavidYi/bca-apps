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
    <input type="hidden" name="action" value="generateS">
    <label>Mentor:</label>
    <select name="mentor">
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
                htmlspecialchars($mentor['mentor_company'])?>)
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <label>Session:</label>
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

    <br>
    <input type="submit" value="Generate Session Sign in">
</form>

<form action="." method="post">
    <input type="hidden" name="action" value="generateT">
    <input type="submit" value="Generate Mentor Check in">
</form>
</body>
</html>
