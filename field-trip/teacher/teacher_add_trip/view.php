<!doctype html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Pontano+Sans" rel="stylesheet">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link href="view.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="add_course">

            <div id="box">
                <p class="title">Create Trip</p>

                <div class = "trip_input">
                    <label class="spacing" for= "trip_name">Trip Name</label>
                    <input type="text" name="trip_name" required>
                </div>

                <div class = "trip_input">
                    <label class="spacing" for= "start_date">Start Date</label>
                    <input type="date" name="start_date" class="datepicker">
                </div>

                <div class = "trip_input">
                    <label class="spacing" for= "end_date">End Date</label>
                    <input type="date" name="end_date" class="datepicker">
                </div>

               <div class = "trip_input">
                    <label class="spacing" for = "purpose">Purpose of Trip</label>
                    <textarea type="textarea" name="purpose" required></textarea>
                </div>

                <div class="button_wrapper">
                    <button class="submit back" type="button" onclick="location.href='../index.php'">Back</button>
                    <button class="submit s" type="submit" name="choice" value="Add Course">Submit</button>
                </div>
            </div>
        </form>

  </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
   <script>
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
          });
        </script>
</html>
