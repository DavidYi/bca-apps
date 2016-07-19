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
        <th>M</th>
        <th>T</th>
        <th>W</th>
        <th>R</th>
        <th>F</th>
        </thead>
        <tbody class="table-hover">
        <?php
        $days = array('M', 'T', 'W', 'R', 'F');
        $mods = array('1-3', '4-6', '7-9', '10-12', '13-15', '16-18', '19-21', '22-24');
        // each row
        for ($i = 0; $i < 8; $i++) {
            echo "<tr id=$mods[$i]>";

            // each column
            for ($j = 0; $j < 5; $j++) {
                $available = false;
                $id = $days[$j] . ' ' . $mods[$i];

                // check if the time is available
                $time;
                foreach ($available_times as $name) {
                    $time = $name['time_short_desc'];

                    // if available, make data-chosen true
                    if (strcmp($time, $id) == 0) {
                        echo "<td class='availability' data-chosen='true' id='" . $id . "' 
                    style='background:#F4ABF1'>" . $mods[$i] . "</td>";
                        $available = true;
                        break;
                    }
                }

                // if not, make data-chosen false
                if (!$available) {
                    echo "<td class='availability' data-chosen='false' id='" . $id . "'>" . $mods[$i] . "</td>";
                } else {
                    unset($available_times[$time]);
                }
                $available = false;
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <form action="index.php" method="post">
        <input type="hidden" name="id_field" id="id_field" data-ids="">
        <input type="hidden" name="action" value="update_times">
        <div class="wrapper">
            <button onclick="update_times();" id="update" value="update_times" class="s submit" type="submit">Submit</button>
            <button onclick="location.href='../index.php'" class="s back" type="submit">Back</button>
        </div>
    </form>


    <!--        <a href="index.php?action=modify_times">Modify Availability</a>-->
<!--    <a href="index.php?action=update_times">Modify Availability</a>-->

</div>
</body>

<script>
    $('.availability').click(function() {
        if ($(this).attr('data-chosen') == 'false'){
            $(this).css("background","#F4ABF1");
            $(this).attr("data-chosen", 'true');
        } else {
            if ($(this).hasClass("even")) {
                $(this).css("background","#D5DDE5");
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
        $('#id_field').attr("value", ids);

    }
</script>

</html>