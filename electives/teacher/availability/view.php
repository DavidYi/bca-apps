<html>
<head>
    <link rel="stylesheet" href="../../Student/times/index.css">
    <script src="../../js/jquery.min.js"></script>


</head>
<body>

<div class="table-title">
    <h3>Select Available Mods</h3>
</div>

<div class="vertical-center">
    <table class="table-fill">
        <thead id="days">
            <tr>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>R</th>
                <th>F</th>
            </tr>
        </thead>
        <tbody class="table-hover">
        <?php
        $mods = array('1-3', '4-6', '7-9', '10-12', '13-15', '16-18', '19-21', '22-24');
        $time_ids = array(1, 10, 17, 25, 33, 2, 11, 18, 26, 34, 3, 41, 19, 27, 35, 4, 12, 20, 28, 36,
                            5, 13, 21, 29, 37, 6, 14, 22, 30, 38, 7, 15, 23, 31, 39, 8, 16, 24, 32, 40);
        // each row, 8 rows for 8 periods
        $index = 0;
        for ($i = 0; $i < 8; $i++) {
            if ($i % 2 == 1) {
                echo "<tr class='even' id=$mods[$i]>";
            } else {
                echo "<tr class='odd' id=$mods[$i]>";
            }

            // each column, 5 columns for 5 days of the week
            for ($j = 0; $j < 5; $j++) {
                $available = false;
                // check if the time is available
                $time;
                foreach ($available_times as $name) {
                    $time = $name['time_id'];

                    // if available, make data-chosen true
                    if (strcmp($time_ids[$index], $time) == 0) {
                        echo "<td class='availability' data-chosen='true' id='" . $time_ids[$index] . "' 
                                style='background:#F4ABF1'>" . $mods[$i] . "</td>";
                        $available = true;
                        $index++;
                        break;
                    }
                }

                // if not, make data-chosen false
                if (!$available) {
                    echo "<td class='availability' data-chosen='false' id='" . $time_ids[$index] . "'>" . $mods[$i] . "</td>";
                    $index++;
                }
                $available = false;
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <div class="wrapper">
        <form action="index.php" method="post">
            <input type="hidden" name="id_field" id="id_field" data-ids="">
            <input type="hidden" name="action" value="update_times">
            <input type="hidden" name="next_page" value="<?php echo $next_page?>">

            <button onclick="update_times();" id="update" value="update_times" class="s submit" type="submit">Submit</button>
        </form>

        <?php
        if ($user->usr_type_cde == 'TCH') {
            echo "<button onclick=" . "\"location.href = '../index.php'\"" . "class='s back' type='submit'>Back</button>";
        } else {
            echo "<button onclick=" . "\"location.href = '../../Student/index.php'\"" . "class='s back' type='submit'>Back</button>";
        }
        ?>

    </div>

</div>
</body>

<script>
    $('.availability').click(function() {
        if ($(this).attr('data-chosen') == 'false'){
            $(this).css("background","#F4ABF1");
            $(this).attr("data-chosen", 'true');
        } else {
            if ($(this).parents('.even').length == 1) {
                $(this).css("background","#d3d3d3");
            } else {
                $(this).css("background","#EBEBEB");
            }
            $(this).attr("data-chosen", "false");
        }
    });

    function update_times() {
        var ids = $("td[data-chosen='true']").map(function(index) {
            return this.id;
        });
        var json = JSON.stringify(ids);
        $('#id_field').attr("value", json);

    }
</script>

</html>