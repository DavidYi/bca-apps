<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    function deleteMentor(mentorID) {
        if (confirm('Are you sure you would like to delete this workshop?')) {
            window.parent.parent.location.href = 'view.php?action=delete_workshop&workshop_id=' + workshopID;
        }
    }

</script>
<head>
    <title>Admin: Workshop</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../admin/ss/main.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
<header>
    <h1 class="title">Workshops</h1>
</header>

<nav class="navbar">
    <div id="navinside">
        <a href="#">
            <div id="namenav"class="session-filter">Name</div>
        </a>
        <a href="#">
            <div id="formatnav"class="session-filter">Format</div>
        </a>
    </div>
</nav>


<div class="list-container">

    <?php foreach ($workshopList as $workshop) {
        $workshop_id = $workshop['wkshp_id'];
        $workshop_name = $workshop['wkshp_nme'];
        $workshop_desc = $workshop['wkshp_desc'];
        $format_id = $workshop['format_id'];
        $format = get_format($format_id);
        $format_name = $format['format_name']

    ?>
        <a href="./index.php?workshop_id=<?php echo $workshop_id ?>&action=show_modify_workshop">
        <div class="mentor" id="workshop">
            <div class="session-filter"><?php echo($workshop_name); ?></div>
            <a class="info" style="position: relative; float:left;z-index: 90; color: #555555;" onclick="popup('#B<?php echo ($workshop['wkshp_id']);?>,#P<?php echo ($workshop['wkshp_id']);?>')">&#x271A;&#xa0;&nbsp;</a>
            <div class="session-filter"style="float:right;"><?php echo($format_name); ?></div>
        </div>
        </a>
        <div class="popup-bg" id="B<?php echo $workshop['wkshp_id']?>" style="display: none;
          opacity: 0.7;
          background: #000;
          width: 100%;
          height: 100%;
          z-index: 10;
          top: 0;
          left: 0;
          position: fixed;">
        </div>

        <div class="popup" id="P<?php echo ($workshop['wkshp_id']);?>"
            <div class="entpop" >
                <div class="close">
                    <div class="presname"><?php echo ($workshop['wkshp_nme']);?></div>
                    <div class="x""><a href="#" style="color:#f0c30f" onclick="cpopup('#B<?php echo $workshop['wkshp_id']?>,#P<?php echo $workshop['wkshp_id']?>')">&#x2716;</a></div>
            </div>
            <div class="popup-c">
                <p><?php echo ($workshop['wkshp_desc']);?></p>
            </div>
        </div>
        
     <?php } ?>
</div>


<div class="fab">
    <a id="fab-action" trigger="./index.php?workshop_id=<?php echo $workshop_id_id?>&action=show_add_workshop"><span class="plus">+</span></a>
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
