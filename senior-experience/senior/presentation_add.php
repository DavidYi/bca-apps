<html lang="en">
<head>
    <title>Senior Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300italic,300' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-2.2.1.min.js<?php echo(getVersionString()); ?>"></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="../ss-add/ss/main.css<?php echo(getVersionString()); ?>" >


</head>
<body>


<div id="mentor_add">
    <section class="add">
        <h1>Add Presentation</h1>
        <BR>
        <!-- Styles --section class id?-->

        <form id="add-pres" action="index.php" method="post">
            <input type="hidden" name="action" value="add_presentation">

            <div class="input input--add">
                <input class="input-field add-field" title="" type="text" name="pres_title" required/>
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Presentation Title</div>
            </div>

            <div class="input input--add">
                <input class="input-field add-field" title="" type="text" name="pres_desc" required />
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Presentation Description</div>
            </div>

            <div class="input input--add">
                <input class="input-field add-field"  title="" type="text" name="organization" required/>
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Organization</div>
            </div>

            <div class="input input--add">
                <input class="input-field add-field" type="text" title="" type="text" name="location" required/>
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Location</div>
            </div>

            <div class="input ui selection dropdown half-size">
                <input type="hidden" name="field_id">
                <i class="dropdown icon"></i>
                <div class="default text">Field</div>
                <div class="menu">
                    <?php
                    foreach ($fields as $field) {?>
                        <div class="item" data-value="<?php echo $field['field_id'];?>"><?php echo($field['field_name']);  ?></div>
                    <?php } ?>
                    <!--need to add code to take the values-->
                    <!--su min says can be done with javascript-->
                    <!--below is the php code that idk how to incorporate to the dropdown-->
                </div>
            </div>

            <div class="input ui selection dropdown half-size">
                <input type="hidden" name="session_room_id">
                <i class="dropdown icon"></i>
                <div class="default text">Session/Room</div>
                <div class="menu">
                    <?php
                    foreach ($sessions as $session) {?>
                        <div class="item" data-value=<?php echo $session['ses_id'];?>:<?php echo $session['rm_id'];?>>Ses: <?php echo($session['ses_id']);  ?>, Rm: <?php echo($session['rm_nbr']);  ?></div>
                    <?php } ?>
                    <!--need to add code to take the values-->
                    <!--su min says can be done with javascript-->
                    <!--below is the php code that idk how to incorporate to the dropdown-->
                </div>
            </div>

            <div class="input ui loading fluid multiple search selection dropdown team-member">
                <input type="hidden" name="team-members" value="">
                <input class="search">
                <div class="default text">Search for team members...</div>
                <div class="menu">
                    <?php
                    foreach ($teammates as $teammember) {?>
                        <div class="item" data-value="<?php echo $teammember['usr_id'];?>"><?php echo($teammember['usr_first_name']);  ?> <?php echo($teammember['usr_last_name']);  ?></div>
                    <?php } ?>
                </div>
            </div>

            <!--Add session and room dropdown data!-->
            <!--Prevent users who have already signed up for a presentation from adding one!-->
            <!--Integrate with Su Min's dynamic page!-->

            <input type="submit" value="Add" class="button" style="color:black">

            <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
        </form>
    </section>
    <!--JavaScript -->
    <script src="../ss-add/js/classie.js<?php echo(getVersionString()); ?>"></script>
    <script src="../ss-add/js/semantic.min.js<?php echo(getVersionString()); ?>"></script>
    <script type="text/javascript">
        $('.ui.dropdown')
            .dropdown()
        ;
    </script>
</div>
</body>
</html>