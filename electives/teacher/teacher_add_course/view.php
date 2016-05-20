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



        <button class="submit s" type="submit">Submit</button>
        <button class="submit back" type="submit" name="choice" value="Back">Back</button>
      </form>
  </div>
  </body>
</html>
<!-- 
.submit {
  display: inline-block;
  /*border-radius: 2px;*/
  color: #ffffff;
  font-weight: bold;
  box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, 0.08);
  padding: 14px 22px;
  border: 0;
  /*margin: 100px 183px 0;*/
  text-align: center;
}

.s {
  margin-left: 160px;
  background-color: #6caee0;
  margin-top: 140px;
}

.back {
  background-color: #f7b57d;
  margin-top: 40px;
} -->
