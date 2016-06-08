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
        $(document).ready(function () {
            $('#basicExample').timepicker();

            $('.ui.dropdown')
                .dropdown()
            ;
        });


    </script>
</head>


<body>

<div id="parents">
    <form action="." method="post" id="inputs">
        <input type="hidden" name="action" value="add_test">

        <input name="test_name" placeholder="Test Name">

        <input name="date" placeholder="Date" type="text" id="datepicker">

        <select name="test_cde" class="ui dropdown">
            <i class="dropdown icon"></i>
            <option value="">Test Type</option>
            <?php
            $num = 0;
            foreach ($testTypes as $test) { ?>
                <option value="<?php echo $test['test_type_cde']; ?>"><?php echo $test['test_type_desc'] ?></option>

                <?php $num += 1;
            } ?>
        </select>

        <!-- Test -->

        <select name="room_id" class="ui dropdown">
            <i class="dropdown icon"></i>
            <option value="">Room Number</option>
            <?php
            $num = 0;
            foreach ($rooms as $room) { ?>
                <option value="<?php echo $room['rm_id']; ?>"><?php echo $room['rm_nbr'] ?></option>
                <?php $num += 1;
            } ?>
        </select>

        <!-- Time -->

        <hr>

        <p class="proctortitle">Proctors Needed</p>

        <table class="tg">
            <tr>
                <th class="tg-031e">
                    <div class="ui labeled input">
                        <div class="ui label">01 - 03</div>
                        <input name="one_three" type="text" class="modinput">
                    </div>
                </th>
                <th class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">04 - 06</div>
                        <input name="four_six" type="text" class="modinput">
                    </div>
                </th>
                <th class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">07 - 09</div>
                        <input name="seven_nine" type="text" class="modinput">
                    </div>
                </th>
            </tr>
            <tr>
                <td class="tg-031e">
                    <div class="ui labeled input">
                        <div class="ui label">10 - 12</div>
                        <input name="ten_twelve" type="text" class="modinput">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">13 - 15</div>
                        <input name="thirteen_fifteen" type="text" class="modinput">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">16 - 18</div>
                        <input name="sixteen_eighteen" type="text" class="modinput">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">19 - 21</div>
                        <input name="nineteen_twentyone" type="text" class="modinput">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">22 - 24</div>
                        <input name="twentytwo_twentyfour" type="text" class="modinput">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">25 - 27</div>
                        <input name="twentyfive_twentyseven" type="text" class="modinput">
                    </div>
                </td>
            </tr>
        </table>

        <button type="submit" name="choice" value="Add">Add</button>

    </form>
</div>
</body>
</html>
