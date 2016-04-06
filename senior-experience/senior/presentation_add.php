<html lang="en">
<head>
    <title>Senior Experience 2016</title>
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

        <form action="index.php" method="post">
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

            <label>Field</label>
            <select name="field_id" title=".">
                <br />
                <b>Notice</b>:  Undefined variable: fields in <b>C:\xampp\htdocs\bca-apps\senior-experience\senior\presentation_add.php</b> on line <b>53</b><br />
                <br />
                <b>Warning</b>:  Invalid argument supplied for foreach() in <b>C:\xampp\htdocs\bca-apps\senior-experience\senior\presentation_add.php</b> on line <b>53</b><br />
            </select><BR>

            <label>Room</label>
            <select name="rm_id" title=".">
                <!-- Add php stuff !-->
            </select><BR>

            <label>Session</label>
            <select name="ses_id" title=".">
                <!-- Add php stuff !-->
            </select><BR>

            <!--Add session and room dropdown data!-->
            <!--Prevent users who have already signed up for a presentation from adding one!-->
            <!--Integrate with Su Min's dynamic page!-->

            <input class="button" type="submit" value="Add">

            <div class="button">
                <button>SAVE</button>
            </div>

            <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
        </form>
    </section>
    <!--JavaScript -->
    <script src="js/classie.js"></script>
    <script src="js/semantic.min.js"></script>
    <script type="text/javascript">
        $('.ui.dropdown')
            .dropdown()
        ;
    </script>
</div>
</body>
</html>