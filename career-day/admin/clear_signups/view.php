<html>
<head>
    <title>Clear Student Signups</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../../shared/ss/main.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

</head>
<body style="text-align:center; padding-top:10%;">
    <h1>Clear Student Signups</h1>
    <p>Check the boxes below and hit "Delete" to clear all user selections.<br>
        Understand that this option should only be done once per year, just before setting up for a new Career Day. </p>
    <br>
    <form action="index.php?action=delete_all" method="post">
    <input style=""type="checkbox" name="box1"><label>I understand that this will clear all student signups.</label>
    <br>
    <label><input style=""type="checkbox" name="box2">I understand that this operation can not be undone.</label>
    <br>
    <div class="button-container">
        <button class="add" name="choice" type="submit" value="Delete">Clear All</button>
        <button class="add" name="choice" type="submit" value="Back">Go Back</button>
    </div>
    </form>
</body>
</html>