<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link href="view.css" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
          
        <script>
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
          });
        </script>

    </head>
    <body>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="add_course">

            <div id="box">
                <p class="title">Create Trip</p>

                <label class="spacing">
                    <span>Trip Name</span>
                    <input type="text" name="trip_name" required>
                </label>

                <label class="spacing">
                    <span>Start Date</span>
                    <input type="date" class="datepicker">
                </label>

                <label class="spacing">
                    <span>Trip Name</span>
                    <input type="text" name="trip_name" required>
                </label>

                <label class="spacing">
                    <span>Purpose</span>
                    <textarea name="trip_purpose" required></textarea>
                </label>

                <div class="button_wrapper">
                    <button class="submit back" type="button" onclick="location.href='../index.php'">Back</button>
                    <button class="submit s" type="submit" name="choice" value="Add Course">Submit</button>
                </div>
            </div>
        </form>

  </body>
</html>
