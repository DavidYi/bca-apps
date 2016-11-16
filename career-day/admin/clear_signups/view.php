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
        <table>
            <tr><td><input style=""type="checkbox"></td>
                <td>I understand that this will clear all student signups.</td>
            </tr>
            <tr><td><input style=""type="checkbox"></td>
                <td>I understand that this operation can not be undone.</td>
            </tr>
        </table>

    <div class="button-container">
        <button class="s" name="choice" type="submit" value="Delete">Clear All</button>
        <button class="b" name="choice" type="submit" value="Back">Go Back</button>
    </div>
    </form>
</body>
</html>