<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="view.css" rel="stylesheet" type="text/css" />

  </head>
  <body>
    <form action="." method="post">
      <input type="hidden" name="action" value="add_course">

    <div id="box">
      <p class="title">Create Course</p>

        <label class="spacing">
          <span>Course Name</span>
          <input type="text" name="class_name">
        </label>


        <label class="spacing">
            <span>Description</span>
            <textarea name="description"></textarea>
        </label>



        <button class="submit" type="submit">Submit</button>
        <input type="submit" name="choice" value="Back">
      </form>
  </div>
  </body>
</html>
