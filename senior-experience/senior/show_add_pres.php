
<html>
<head>

</head>
<body>

<h1>Add Presentation</h1>
<div id="mentor_add">

    <BR>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_pres_into_db">
        <br>
        <label>Presentation Title</label>
        <br>
        <label>Presentation Description</label>
        <br>
        <label>Organization</label>
        <br>
        <label>Location</label>
        <br>
        <label>Field</label>
        <br>
        <label>Room</label>
        <br>
        <label>Session</label>
        <br>
        <!--Add session and room dropdown data!-->
        <!--Prevent users who have already signed up for a presentation from adding one!-->
        <!--Integrate with Su Min's dynamic page!-->

        <input type="submit" value="Add">
        <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
    </form>
</div>
</body>
</html>