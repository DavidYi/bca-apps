<html>

<head>
    <link rel="stylesheet" type="text/css" href="../add/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../add/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="../add/jquery.timepicker.js"></script>
    <script src="../add/functions.js"></script>
    <script src="../add/semantic/dist/semantic.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#basicExample').timepicker();

            $('.ui.dropdown').selectmenu();
        });
    </script>
</head>


<body>



<div id="parents">

    <form action="." method="post" id="inputs">

        <input type="hidden" name="action" value="modify_delete_test">

        <select id="test_list" name="test_list">
            <i class="dropdown icon"></i>
            <option value="" disabled selected>Test List</option>
            <?php $keyIndex = 0;
            foreach($distinct_test_list as $test) { ?>
                <?php $test_key = $test_keys[$keyIndex++];
                $testval = $test_key . ":" .
                    implode(",", $distinct_test_list[$test_key]['procs_needed']) ?>
                <option value="<?php echo $testval?>">
                    <?php echo $test['test_name']."/".$test['test_dt']."/".$test['test_type']."/".$test['rm_id']?>
                </option>
            <?php } ?>
        </select>

        <input name="test_name" placeholder="Test Name">

        <input name="date" placeholder="Date" type="text" id="datepicker">

        <select name="test_cde" class="ui dropdown">
            <i class="dropdown icon"></i>
            <option value="" disabled selected>Test Type</option>
            <?php foreach ($testTypes as $test) { ?>
                <?php if ($user->getRole("TPOR") == $test['test_type_cde'] || $user->getRole("TPOR") == "ADM") { ?>
                    <option value="<?php echo $test['test_type_cde']?>">
                        <?php echo $test['test_type_desc']?>
                    </option>
                <?php }
            } ?>
        </select>

        <!-- Test -->

        <select name="room_id" class="ui dropdown">
            <i class="dropdown icon"></i>
            <option value="" disabled selected>Room Number</option>
            <?php
            foreach ($rooms as $room) { ?>
                <option value="<?php echo $room['rm_id']; ?>"><?php echo $room['rm_nbr']?></option>
            <?php } ?>
        </select>

        <!-- Time -->
        <hr>


        <p class="proctortitle">Proctors Needed</p>

        <table class="tg">
            <tr>
                <th class="tg-031e">
                    <div class="ui labeled input">
                        <div class="ui label">01 - 03</div>
                        <input name="one_three" type="text" class="modinput" value="0">
                    </div>
                </th>
                <th class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">04 - 06</div>
                        <input name="four_six" type="text" class="modinput" value="0">
                    </div>
                </th>
                <th class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">07 - 09</div>
                        <input name="seven_nine" type="text" class="modinput" value="0">
                    </div>
                </th>
            </tr>
            <tr>
                <td class="tg-031e">
                    <div class="ui labeled input">
                        <div class="ui label">10 - 12</div>
                        <input name="ten_twelve" type="text" class="modinput" value="0">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">13 - 15</div>
                        <input name="thirteen_fifteen" type="text" class="modinput" value="0">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">16 - 18</div>
                        <input name="sixteen_eighteen" type="text" class="modinput" value="0">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">19 - 21</div>
                        <input name="nineteen_twentyone" type="text" class="modinput" value="0">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">22 - 24</div>
                        <input name="twentytwo_twentyfour" type="text" class="modinput" value="0">
                    </div>
                </td>
                <td class="tg-yw4l">
                    <div class="ui labeled input">
                        <div class="ui label">25 - 27</div>
                        <input name="twentyfive_twentyseven" type="text" class="modinput" value="0">
                    </div>
                </td>
            </tr>
        </table>

        <button type="submit" name="choice" value="Modify">Modify</button>
        &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <button type="submit" name="choice" value="Delete">Delete</button>

    </form>
</div>
<script>
    $('#test_list').change(function() {
        var test_value = $(this).val().split(":");
        var test_id = test_value[0];
        var test_proctors = test_value[1].split(",");
        var test_data = $(this).find('option:selected').text().split("/");
        var test_date = test_data[1].trim().split("-");
        test_date = test_date[1] + "/" + test_date[2] + "/" + test_date[0];
        $('input[name=test_name]').val(test_data[0].trim());
        $('input[name=date]').val(test_date);
        $('select[name=test_cde]').val(test_data[2]);
        var proc_index = 0;
        $(".modinput").each(function() {
            $(this).val(test_proctors[proc_index++]);
        });
    });

</script>
</body>
</html>
