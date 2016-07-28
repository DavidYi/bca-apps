<html>
    <head>
        <title>Elective Availability</title>
        <link rel="stylesheet" href="view.css">
        <link rel="stylesheet" href="../../../shared/ss/main.css">
        <style>
            .enrollment .session:hover {
                background: #cce6ff;
            }

            button {
                background-color: #00b8e6;
                position: absolute;
                left: 70%;
                top: 20%;
            }

        </style>
    </head>
    <body>
        <section class="main">
            <header>
                <h1 class="title main-title">Teacher Availability</h1>
                <a href="../index.php"><button style="float: right; width: 10em;"
                        data-value=>Back
                </button></a>
            </header>

            <nav class="navbar" style="width:85%;">
                <a href="">
                    <div class="session-filter tag" style="width:25%;text-align:left">Teacher</div>
                </a>
                <a href="">
                    <div class="session-filter company" style="width:65%;text-align:left">Free Mods</div>
                </a>
                <a href="">
                    <div class="session-filter remaining" style="width: 5%; float: right; text-align: right">Modify</div>
                </a>
            </nav>

            <div class="enrollment">
                <?php foreach ($free_mods as $teacher) {
                    $firstName = $teacher['usr_first_name'];
                    $lastName = $teacher['usr_last_name'];
                    $freeMods = $teacher['mods_available'];
                    ?>
                    <div class="session makeDefault" data-value="what">
                        <div class="tag" style="width: 25%"><?php echo $lastName ?>, <?php echo $firstName ?></div>
                        <div class="company" style="width: 65%"><?php echo $freeMods ?></div>
                        <div class="remaining" style="width: 5%; float: right; text-align: right">
                            <a style="color: #555" href="index.php?action=modify&usr_id=<?php echo $teacher['usr_id'] ?>"><h4 style="line-height: inherit">m</h4></a>


                        </div>


                    </div>
                <?php } ?>
            </div>
        </section>
    </body>
</html>