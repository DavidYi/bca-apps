<html>
<head>

</head>

<body>
<h1>Add Mentor</h1>
<div id="mentor_add">

    <BR>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_pres_into_db">

        <label>Presentation Title</label>
        <input title="" type="text" name="title" required><BR>

        <label>Description</label>
        <input title="" type="text" name="desc" required><BR>

        <label>Organization</label>
        <input title="" type="text" name="organization" required><BR>

        <label>Location</label>
        <input title="" type="text" name="location" required><BR>

        <label>Presenter Names</label>
        <input title="" type="text" name="names" required><BR>


        <input type="submit" value="Add">
        <button><a href="index.php?action=show_pres" style="text-decoration: none; color: black">Cancel</a></button>
    </form>
</div>
</body>
</html>