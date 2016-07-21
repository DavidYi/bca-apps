<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Table Style</title>
    <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
    <link rel="stylesheet" href="index.css">
    <script src="../../js/jquery/min.js"></script>



</head>

<body>
<div class="table-title">
    <h3>Course Interests</h3>
</div>

<form action="index.php" method="POST">
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
                    <input type="checkbox" id="<?php $course['course_id'] ?>" name="checkbox[]" >
                    <div class="slider round"></div>
                </label>

                <!-- to find course id: $course['course_id']-->


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
        <button class="submit" type="submit" onclick="submit_courses">Submit</button>
    </div>
</form>

<button class="s back" onclick="location.href = '../index.php'" type="submit">Back</button>

</body>


<script>

    function submit_courses(){

        var ids = $("input:checkbox[name='checkbox[]']:checked").map(function(index) {
            return this.id;
        });


        var index;

        for (index = 0; index < ids.length; ++index) {


            console.log (ids[index]);





        }

    }


</script>




</html>
