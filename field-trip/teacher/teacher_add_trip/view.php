<!doctype html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Pontano+Sans" rel="stylesheet">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css<?php echo(getVersionString()); ?>">
        <link href="view.css<?php echo(getVersionString()); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="add_trip">

            <div id="box">
                <p class="title">Create Trip</p>

                <div class = "trip_input">
                    <label class="spacing" for= "trip_name">Trip Name</label>
                    <input type="text" name="trip_name" required>
                </div>

                <div class = "trip_input destination">
                    <label class="spacing" for= "destination">Destination</label>
                    <input type="text" name="destination" required>
                </div>

                <div class = "trip_input num_students">
                    <label class="spacing" for= "num_students"># of Students</label>
                    <input type="text" name="num_students" required>
                </div>

                <div class = "trip_input date_time date">
                    <label class="spacing" for= "start_date">Start Date</label>
                    <input type="date" name="start_date" class="datepicker">
                </div>

                <div class = "trip_input date_time time">
                    <label class="spacing" for= "start_time">Start Time</label>
                    <input type="text" name="start_time" class="timepicker">
                </div>
 
                <div class = "trip_input date_time date">
                    <label class="spacing" for= "end_date">End Date</label>
                    <input type="date" name="end_date" class="datepicker">
                </div>

                <div class = "trip_input date_time time">
                    <label class="spacing" for= "end_time">End Time</label>
                    <input type="text" name="end_time" class="timepicker">
                </div>

               <div class = "trip_input">
                    <label class="spacing" for = "purpose">Purpose of Trip</label>
                    <textarea type="textarea" name="purpose" required></textarea>
                </div>

                <div class="button_wrapper">
                    <button class="submit back" type="button" onclick="location.href='../index.php'">Back</button>
                    <button class="submit s" type="submit" name="choice" value="Add Trip">Submit</button>
                </div>
            </div>
        </form>

  </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js<?php echo(getVersionString()); ?>"></script>
    <script src="../../js/picker.js<?php echo(getVersionString()); ?>"></script>
    <script src="../../js/picker.time.js<?php echo(getVersionString()); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js<?php echo(getVersionString()); ?>"></script>
   <script>
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year
            format: 'yyyy-mm-dd'
          });

        $('.timepicker').pickatime();
        </script>
</html>
