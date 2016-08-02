<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript">
        function deleteRoom(roomID) {
            if (confirm('Are you sure you would like to delete this room?')) {
                window.parent.parent.location.href = 'index.php?action=delete_room&room_id=' + roomID;
            }
        }
    </script>
    <head>
        <title>Admin: Room</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Styles -->
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="../../../shared/room/styles.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <h1 style="margin:0;" class="title">Rooms</h1>
        </header>
        <div style="text-align:center;padding-bottom:2vh;">
            <a href="./index.php?action=show_add_room">
                <button id="add_room">Add Room</button>
            </a>
            <a href="../index.php">
                <button id="return_home">Return Home</button>
            </a>
        </div>
        <nav style="width:40%" class="navbar">
            <div id="navinside">
                <a href="#">
                    <div id="namenav" class="session-filter"><h2><strong>Room</strong></h2></div>
                </a>
                <a href="#">
                    <div style="float:right;" id="delnav" class="session-filter"><h2><strong>Delete</strong></h2></div>
                </a>
            </div>
        </nav>


        <div style="width:40%;" class="list-container">

            <?php foreach ($roomList as $room) {
                $room_id = $room['rm_id'];
                $room_nbr = $room['rm_nbr'];
                ?>

                <div class="mentor" id="room">
                    <a href="./index.php?room_id=<?php echo $room_id ?>&action=show_modify_room">
                        <div class="session-filter room_name"><h2><?php echo($room_nbr); ?></h2></div>
                    </a>
                    <div style="float:right;">
                        <div class="session-filter delete">
                            <h4 class="del_icon" onclick="deleteWorkshop(<?php echo $room_id; ?>);">d</h4>
                        </div>
                    </div>
                </div>

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
