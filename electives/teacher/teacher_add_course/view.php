<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="view.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="add_course">

            <div id="box">
                <p class="title">Create Course</p>

                <label class="spacing">
                    <span>Course Name</span>
                    <input type="text" name="course_name" required>
                </label>

                <label class="spacing">
                    <span>Description</span>
                    <textarea name="course_desc" required></textarea>
                </label>

                <div class="button_wrapper">
                    <button class="submit back" type="button" onclick="location.href='../index.php'">Back</button>
                    <button class="submit s" type="submit" name="choice" value="Add Course">Submit</button>
                </div>
            </div>
        </form>

  </body>
</html>
