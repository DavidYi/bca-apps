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

<h1>Please choose the specific session and mentor to generate out the sign in sheet or choose all mentor to get the
    mentor sign in sheet:</h1>
<form action="." method="post">
    <input type="hidden" name="action" value="generate">
    <label>Mentor:</label>
    <select name="mentor">
        <option value="all" selected="selected">All Mentors</option>
        <?php foreach ($mentors as $mentor) :
            if (($mentor['mentor_id'] == $mentor_id)) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>
            <option value="<?php echo $mentor['mentor_id']; ?>" selected="<?php
            echo $selected ?>">
                <?php echo htmlspecialchars($mentor['mentor_last_name']) ?>, <?php
                echo htmlspecialchars($mentor['mentor_first_name']); ?> (<?php echo
                htmlspecialchars($mentor[mentor_company]) ?>)
            </option>
        <?php endforeach; ?>
    </select>
    <select name="session">
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

    <input type="submit" value="Generate">\
</form>
</body>
</html>
