<html lang="en">
<head>
    <title>Senior Experience</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300italic,300' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="../ss-add/ss/main.css" >W

    <script type="text/javascript">
        function deletePresentation(presID)
        {
            if (confirm('Are you sure you would like to delete the presentation?'))
            {
                window.parent.parent.location.href = 'index.php?action=delete_presentation&pres_id=' + presID;
            }
        }
        function cancelPresentation()
        {
            if (confirm('Are you sure you would like to go back?'))
            {
                window.parent.parent.location.href = 'index.php';
            }
        }
    </script>

</head>
<link rel="stylesheet" type="text/css" href="../ss-add/ss/main.css">
<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300italic,300' rel='stylesheet' type='text/css'>

<body>
    <section class="add">
        <h1>Modify Presentation</h1>
        <form action="." method="post">
            <input type="hidden" name="action" value="modify_presentation">
            <input type="hidden" name="pres_id" value="<?php echo $presentation->pres_id ?>">

            <div class="input input--add">
                <input class="input-field add-field" type="text" name="title" id="title" required/>
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Presentation Title</div>
            </div>

            <div class="input input--add">
                <input class="input-field add-field"type="text" name="desc" id="desc" required/>
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Presentation Description</div>
            </div>

            <div class="input input--add">
                <input class="input-field add-field" type="text" name="organization" id="organization" required/>
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Organization</div>
            </div>

            <div class="input input--add">
                <input class="input-field add-field" type="text" name="location" id="location" required/>
                <label class="input-label add-label" />
                <div class="input__label-content input__label-content--add">Location</div>
            </div>

             <div class="double">
                <select class="input ui selection dropdown half-size" id="field_id">
                    <?php
                    foreach ($fields as $field) {?>
                        <option class="item" value="<?php echo $field['field_id'];?>"><?php echo($field['field_name']);  ?></option>
                    <?php } ?>
                </select>

                <select class="input ui selection dropdown half-size" name="ses-room-number" id="ses-room-number">
                    <?php
                    foreach ($sessions as $session) {?>
                        <option class="item" value="<?php echo $session['ses_id'];?>:<?php echo $session['rm_id'];?>">Ses: <?php echo($session['ses_id']);  ?>, Rm: <?php echo($session['rm_nbr']);?></option>
                    <?php } ?>
                </select>
            </div>

            <select class="input ui loading fluid multiple search selection dropdown team-member" id="team-member">
                <?php
                foreach ($teammates as $teammember) {?>
                    <option class="item" value="<?php echo $teammember['usr_id'];?>"><?php echo($teammember['usr_first_name']);  ?> <?php echo($teammember['usr_last_name']);  ?></option>
                <?php } ?>
            </select>

        </div>

        <input type="submit" value="Modify" class="button" style="color:black">
        <input type="submit" onClick="cancelPresentation();" value="Cancel" class="button" style="color:black">
        <input type="submit" value="Delete" class="button" onClick="deletePresentation(<?php echo $presentation->pres_id;; ?>);" style="color:black">

                <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
        </form>
    </section>
    <!--JavaScript -->
    <script src="../ss-add/js/classie.js"></script>
    <script src="../ss-add/js/semantic.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#ses-room-number').dropdown('set text', 'Session/Room');
            $('#ses-room-number').dropdown('set value', '<?php echo($presentation->ses_id . ":" . $presentation->rm_id); ?>');

            $('#field_id').dropdown('set text', 'Field');
            $('#field_id').dropdown('set value', '<?php echo $presentation->field_id;?>');

            document.getElementById("title").value = "<?php echo $presentation->pres_title;?>";
            document.getElementById("desc").value = "<?php echo $presentation->pres_desc;?>";
            document.getElementById("organization").value = "<?php echo $presentation->organization;?>";
            document.getElementById("location").value = "<?php echo $presentation->location; ?>";

            //Team members
            $('#team-member').dropdown('set value', [<?php echo $presenter_ids ?>]);

            document.getElementById("pres-name").click();
        });
        $('.ui.dropdown')
            .dropdown()
        ;
        // $('#yoyo').val('0');
    </script>
</body>
