<html>

<head>
    <link rel="stylesheet" type="text/css" href="../add/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="view.css">
    <link href="../../../shared/ss/main.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="../add/jquery.timepicker.js"></script>
    <script src="../add/functions.js"></script>
    <script src="../add/semantic/dist/semantic.min.js"></script>
    <script>
        $(document).ready(function () {

            <?php $test = get_selected_test($test_id) ?>

            $('#basicExample').timepicker();
            $('.ui.dropdown').selectmenu();
            $("#test_cde").val(<?php echo $test[$test_type_cde]?>);
            $("#test_room").val(<?php echo $test[$rm_nbr]?>);

        });
    </script>
</head>


<body>

<header>
    <h1 style="margin:0;" class="title">Modify Test</h1>
</header>
<div id="box">
    <div id="wrapper">
        <div id="columns">
            <form action="." method="post" id="inputs">

                <input type="hidden" name="action" value="modify_delete_test">

                <input type="hidden" name="test_id" value="<?php echo $test_id ?>" required><BR>

                <input class="mod" name="test_name" placeholder="Test Name"
                       value="<?php echo $test_name ?>" required><BR>

                <input class="mod" name="date" placeholder="Date" type="text" id="datepicker"
                       value="<?php echo $test_date ?>" required><BR>

                <select name="test_cde" class="mod" id="test_cde" required>
                    <i class="dropdown icon"></i>
                    <option disabled>Test Type</option>
                    <?php foreach ($testTypes as $test) { ?>
                        <?php if ($user->getRole("TPOR") == $test['test_type_cde'] || $user->getRole("TPOR") == "ADM") { ?>
                            <option value="<?php echo $test['test_type_cde'] ?>">
                                <?php echo $test['test_type_desc'] ?>
                            </option>
                        <?php }
                    } ?>
                </select><BR>

                <!-- Test -->

                <select name="room_id" class="mod" id="test_room" required>
                    <i class="dropdown icon"></i>
                    <option disabled>Room Number</option>
                    <?php
                    foreach ($rooms as $room) { ?>
                        <option value="<?php echo $room['rm_id']; ?>"><?php echo $room['rm_nbr'] ?></option>
                    <?php } ?>
                </select><BR>

                <!-- Time -->

                <hr>

                <p class="proctortitle">Proctors Needed</p>

                <table class="tg">
                    <tr>
                        <td class="tg-yw41">
                            <div class="ui labeled input">
                                <div class="ui label">01 - 03</div>
                                <input name="one_three" type="text" class="modinput"
                                       value="<?php echo $procs_list[0] ?>">
                            </div>
                        </td>
                        <td class="tg-yw4l">
                            <div class="ui labeled input center">
                                <div class="ui label">04 - 06</div>
                                <input name="four_six" type="text" class="modinput"
                                       value="<?php echo $procs_list[1] ?>">
                            </div>
                        </td>
                        <td class="tg-yw4l">
                            <div class="ui labeled input right">
                                <div class="ui label">07 - 09</div>
                                <input name="seven_nine" type="text" class="modinput"
                                       value="<?php echo $procs_list[2] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-031e">
                            <div class="ui labeled input">
                                <div class="ui label">10 - 12</div>
                                <input name="ten_twelve" type="text" class="modinput"
                                       value="<?php echo $procs_list[3] ?>">
                            </div>
                        </td>
                        <td class="tg-yw4l">
                            <div class="ui labeled input center">
                                <div class="ui label">13 - 15</div>
                                <input name="thirteen_fifteen" type="text" class="modinput"
                                       value="<?php echo $procs_list[4] ?>">
                            </div>
                        </td>
                        <td class="tg-yw4l">
                            <div class="ui labeled input right">
                                <div class="ui label">16 - 18</div>
                                <input name="sixteen_eighteen" type="text" class="modinput"
                                       value="<?php echo $procs_list[5] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-yw4l">
                            <div class="ui labeled input">
                                <div class="ui label">19 - 21</div>
                                <input name="nineteen_twentyone" type="text" class="modinput"
                                       value="<?php echo $procs_list[6] ?>">
                            </div>
                        </td>
                        <td class="tg-yw4l">
                            <div class="ui labeled input center">
                                <div class="ui label">22 - 24</div>
                                <input name="twentytwo_twentyfour" type="text" class="modinput"
                                       value="<?php echo $procs_list[7] ?>">
                            </div>
                        </td>
                        <td class="tg-yw4l">
                            <div class="ui labeled input right">
                                <div class="ui label">25 - 27</div>
                                <input name="twentyfive_twentyseven" type="text" class="modinput"
                                       value="<?php echo $procs_list[8] ?>">
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="button-div">
                    <button class="submit s" type="submit" name="choice" value="Modify">Modify</button>
                    <button class="submit k" type="submit"
                            name="choice" value="Delete" formnovalidate>Delete
                    </button>
                </div>
                <div class="button-div">
                    <button class="submit cancel" type="submit"
                            name="choice" value="Return" formnovalidate>Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
