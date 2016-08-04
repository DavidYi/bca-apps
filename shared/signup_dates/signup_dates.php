<!--ideally to be in three columns, rooms 0-99, 100-199, 200-299-->


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin: Room</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Styles -->
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="../../../shared/signup_dates/styles.css" rel="stylesheet">
    </head>

    <body>

    <header>
        <h1 class="title">Signup Dates</h1>
    </header>
    <div class="button-wrap" style="text-align:center;">
        <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Update Dates">Submit</button>
        <button id="return_home" style="cursor: pointer" class="submit cancel" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
    </div>

        <nav style="width:70%" class="navbar">
            <div id="navinside">
                <a href="#">
                    <div class="session-filter organization"><h2>Grade</h2></div>
                </a>
                <a href="#">
                    <div class="session-filter organization"><h2>Description</h2></div>
                </a>
                <a href="#>">
                    <div class="session-filter org2"><h2>Start</h2></div>
                </a>
                <a href="#>">
                    <div class="session-filter org2"><h2>End</h2></div>
                </a>
            </div>
        </nav>


        <div style="width:70%;" class="list-container">

            <?php $i = 0; ?>
            <?php foreach ($signups as $signup){ ?>

                <div class="row" style="padding-top:1em;padding-bottom:1em;padding-left:1.5em;">
                    <input type="hidden" name="hdGrade[<?php echo $i ?>]" value="<?php echo $signup['grade_lvl'] ?>">
                    <input type="hidden" name="hdMode[<?php echo $i ?>]" value="<?php echo $signup['mode_cde'] ?>">

                    <label>
                        <h2 id="line" id="line" class="grade organization"><?php echo $signup['grade_lvl'] ?></h2>
                    </label>
                    <label>
                        <h2 id="line" id="line" class="mode organization"><?php echo $signup['mode_desc'] ?></h2>
                    </label>

                    <input id="line" type="text" class="start org2" style="width:calc(25% - 5em);" name="start[<?php echo $i ?>]" value="<?php echo $signup['start']?>">
                    <input id="line" type="text" class="end org2" style="margin-left:5em; width:calc(25% - 5em)" name="end[<?php echo $i ?>]" value="<?php echo $signup['end']?>">
                </div>

                <?php $i = $i + 1; ?>

            <?php } ?>
        </div>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('body').plusAnchor({
                    easing: 'easeInOutExpo',
                    speed: 700
                });
            });

            $('#fab-action').click(function () {
                $.featherlight($('<iframe width="1000" height="800" src="' + $(this).attr('trigger') + '"/>'))
            })
        </script>
    </body>
</html>