<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Table Style</title>
    <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
    <link rel="stylesheet" href="index.css">
</head>

<body>
<div class="table-title">
    <h3>Course Interests</h3>
</div>

<form action="." method="POST">
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Elective</th>
            <th class="text-left">Teacher</th>
            <th class="text-left">Description</th>
            <th class="text-left">Express Interest</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($courseList as $course) { ?>


        <tr>
            <td class="text-left"><label><?php echo $course['course_name']?></label></td>
            <td class="text-left"><label><?php echo $course['teacher']?></label></td>
            <td class="text-left"><label><?php echo $course['course_desc']?></label></td>
            <td  class="text-left">

                <label class="switch">
                    <input type="checkbox" >
                    <div class="slider round"></div>
                </label>



            <script>
                document.getElementById("mods").addEventListener("click", myFunction);

                function changeColor() {
                    document.getElementById("mods").style.color = "blue";
                }
            </script>


        </tr>
        <?php } ?>

        </tbody>
    </table>

    <div class="wrapper">
        <button class="submit" type="submit">Submit</button>
    </div>
</form>

<button class="s back" onclick="location.href = '../index.php'" type="submit">Back</button>

</body>
</html>
