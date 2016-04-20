<?php

?>

<html>

    <head>
        <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="jquery.timepicker.js"></script>
        <script src="functions.js"></script>
        <script src="semantic/dist/semantic.min.js"></script>
        <script>
        $( document ).ready(function() {
          $('#basicExample').timepicker();

          $('.ui.dropdown')
            .dropdown()
          ;
        });



        </script>
    </head>


    <body>

      <div id = "parents">
        <div id = "inputs">

          <input placeholder="Test Name">

          <input placeholder="Date" type="text" id="datepicker">

          <select class="ui dropdown">
            <i class="dropdown icon"></i>
            <option value="">Location</option>
            <option value="1">Rm 138</option>
            <option value="0">Gym</option>
          </select>

          <!-- Test -->

          <select class="ui dropdown">
            <i class="dropdown icon"></i>
            <option value="">Test Type</option>
            <option value="1">PARCC</option>
            <option value="0">SAT 2</option>
          </select>

          <!-- Time -->

          <hr>

          <p class = "proctortitle">Proctors Needed</p>

          <table class="tg">
            <tr>
              <th class="tg-031e"><input placeholder = "1 - 3"  class = "modinput"></th>
              <th class="tg-yw4l"><input placeholder = "4 - 6" class = "modinput"></th>
              <th class="tg-yw4l"><input placeholder = "7 - 9" class = "modinput"></th>
            </tr>
            <tr>
              <td class="tg-031e"><input placeholder = "10 - 12"  class = "modinput"></td>
              <td class="tg-yw4l"><input placeholder = "13 - 15" class = "modinput"></td>
              <td class="tg-yw4l"><input placeholder = "16 - 18" class = "modinput"></td>
            </tr>
            <tr>
              <td class="tg-yw4l"><input placeholder = "19 - 21" class = "modinput"></td>
              <td class="tg-yw4l"><input placeholder = "22 - 24" class = "modinput"></td>
              <td class="tg-yw4l"><input placeholder = "25 - 27" class = "modinput"></td>
            </tr>
          </table>

          <button type="submit" value="Submit">Submit</button>

        </div>
      </div>
    </body>
</html>
