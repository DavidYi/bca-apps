<html lang="en">
<head>
    <title>Senior Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300italic,300' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="../ss-add/ss/main.css" >


</head>
<body>


<div id="mentor_add">
    <section class="add">
        <h1>Add Presentation</h1>
        <BR>
        <!-- Styles --section class id?-->

        <form id="add-pres" action="index.php" method="post">
            <input type="hidden" name="action" value="add_pres_into_db">

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
                <input type="hidden" name="session-room">
                <i class="dropdown icon"></i>
                <div class="default text">Session/Room</div>
                <div class="menu">
                    <div class="item" data-value="0">1</div>
                    <?php
                    foreach ($fields as $field) {?>
                        <div class="item" data-value="<?php echo $field['field_id'];?>"><?php echo($field['field_name']);  ?></div>
                    <?php } ?>
                    <!--add javascript code for this dropdown -->
                </div>
            </div>

            <!--Add session and room dropdown data!-->
            <!--Prevent users who have already signed up for a presentation from adding one!-->
            <!--Integrate with Su Min's dynamic page!-->

            <input class="button" type="submit" value="Add">

            <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
        </form>
    </section>
    <!--JavaScript -->
    <script src="../ss-add/js/classie.js"></script>
    <script src="../ss-add/js/semantic.min.js"></script>
    <script type="text/javascript">
        $('.ui.dropdown')
            .dropdown()
        ;
    </script>
</div>
</body>
</html>