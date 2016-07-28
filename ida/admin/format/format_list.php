<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    function deleteFormat(formatID) {
        if (confirm('Are you sure you would like to delete this format?')) {
            window.parent.parent.location.href = 'index.php?action=delete_format&format_id=' + formatID;
        }
    }

</script>
<head>
    <title>Admin: Format</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../admin/ss/main.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
<header>
    <h1 style="margin:0;"class="title">Formats</h1>
</header>
<div style="text-align:center;padding-bottom:2vh;">
    <a href="./index.php?format_id=<?php echo $format_id ?>&action=show_add_format"><button>Add Format</button></a>
    <a href="../index.php"><button>Return Home</button></a>
</div>
<nav  style="width:40%" class="navbar">
    <div id="navinside">
        <a href="#">
            <div id="namenav"class="session-filter name">Format</div>
        </a>
        <a href="#">
            <div style="float:right;" id="namenav"class="session-filter capacity">Delete</div>
        </a>
    </div>
</nav>


<div style="width:40%;" class="list-container">

    <?php foreach ($formatList as $format) {
        $format_id = $format['format_id'];
        $format_name = $format['format_name'];

    ?>

        <div class="mentor row" id="workshop">
            <a href="./index.php?format_id=<?php echo $format_id ?>&action=show_modify_format">
            <div class="session-filter"><?php echo($format_name); ?></div>
            </a>
            <div style="float:right;">
                <div class="session-filter capacity">
                    <img style="z-index:90;height:2.5vh;"src="../../../shared/images/garbage_can.png" onclick="deleteFormat(<?php echo $format_id; ?>);">
                </div>
            </div>
        </div>
        
     <?php } ?>
</div>
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