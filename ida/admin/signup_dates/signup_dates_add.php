<?php include 'view/header.php'; ?>
<?php include 'view/sidebar.php'; ?>
    <main>
    <h1>Add Sign Up Date</h1>
    <div id="signup_dates_add">

        <?php echo $error_msg ?>
        <BR>

        <form action="." method="post">
            <input type="hidden" name="action" value="add_signup_dates">

            <label>Class Year:</label>
            <input type="text" name="class_year" value="<?php echo htmlspecialchars($class_year);?>"><BR>

            <label>Start:</label>
            <input type="text" name="start" value="<?php echo htmlspecialchars($start);?>"><BR>

            <label>End:</label>
            <input type="text" name="end" value="<?php echo htmlspecialchars($end);?>"><BR>

            <label>&nbsp;</label>
            <input type="submit" name="choice" value="Add">
            <input type="submit" name="choice" value="Cancel">
        </form>
    </div>
    </main>
<?php include 'view/footer.php'; ?>