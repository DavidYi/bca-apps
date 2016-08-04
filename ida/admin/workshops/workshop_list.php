<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript">
        function deleteWorkshop(workshopID) {
            if (confirm('Are you sure you would like to delete this workshop AND ALL presentations associated with it?')) {
                window.parent.parent.location.href = 'index.php?action=delete_workshop&workshop_id=' + workshopID;
            }
        }

    </script>
    <head>
        <title>Admin: Workshops</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Styles -->
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <h1 class="title">Workshops</h1>
        </header>
        <div class="button-wrap">
            <a href="./index.php?workshop_id=<?php echo $workshop_id ?>&action=show_add_workshop"><button id="add_workshop">Add Workshop</button></a>
            <a href="../index.php"><button id="return_home">Return Home</button></a>
        </div>
        <nav  style="width:65%" class="navbar">
            <div id="navinside">
                <a href="#">
                    <div id="namenav"class="session-filter"><h2><strong>Name</strong></h2></div>
                </a>
                <a href="#">
                    <div id="formatnav"class="session-filter"><h2><strong>Format</strong></h2></div>
                </a>
            </div>
        </nav>


        <div style="width:65%;" class="list-container">

            <?php foreach ($workshopList as $workshop) {
                $workshop_id = $workshop['wkshp_id'];
                $workshop_name = $workshop['wkshp_nme'];
                $workshop_desc = $workshop['wkshp_desc'];
                $format_id = $workshop['format_id'];
                $format = get_format($format_id);
                $format_name = $format['format_name']

            ?>

                <div class="mentor" id="workshop">
                    <a class="info" style="position: relative; z-index: 90; color: #555555;" onclick="popup('#B<?php echo ($workshop['wkshp_id']);?>,#P<?php echo ($workshop['wkshp_id']);?>')"><h4 class="info_icon">i</h4></a>
                    <a href="./index.php?workshop_id=<?php echo $workshop_id ?>&action=show_modify_workshop">
                    <div class="session-filter workshop_name"><h2><?php echo($workshop_name); ?></h2></div>
                    </a>
                    <div style="float:right;">
                        <div class="session-filter format_name"><h2><?php echo($format_name); ?></h2></div>
                        <h4 class="del_icon" onclick="deleteWorkshop(<?php echo $workshop_id; ?>);">d</h4>
                    </div>
                </div>
                <div class="popup-bg" id="B<?php echo $workshop['wkshp_id']?>">
                </div>

                <div class="popup" id="P<?php echo ($workshop['wkshp_id']);?>"
                    <div class="entpop" >
                        <div class="close">
                            <div class="presname"><h1><?php echo ($workshop['wkshp_nme']);?></h1></div>
                            <div class="x""><a href="#" style="color:#f0c30f" onclick="cpopup('#B<?php echo $workshop['wkshp_id']?>,#P<?php echo $workshop['wkshp_id']?>')"><h4 id="x">c</h4></a></div>
                    </div>
                    <div class="popup-c">
                        <h2><?php echo ($workshop['wkshp_desc']);?></h2>
                    </div>
                </div>

             <?php } ?>
        </div>
        <script type="text/javascript" src="../../js/popup.js"></script>
        <script type="text/javascript" src="../../js/cpopup.js"></script>
        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.plusanchor.min.js"></script>
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
