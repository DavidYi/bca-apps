<html>
    <head>
        <title>Elective Availability</title>
        <link rel="stylesheet" href="view.css<?php echo(getVersionString()); ?>">
        <link rel="stylesheet" href="../../../shared/ss/main.css<?php echo(getVersionString()); ?>">
        <style>
            .enrollment .session:hover {
                background: #cce6ff;
            }

            button {
                background-color: #00b8e6;
                position: absolute;
                left: 1%;
                top: 8%;
                width: 10%;
            }
        </style>
    </head>
    <body>
        <section class="main">
            <header>
                <BR><h1 class="title main-title">Teacher Availability</h1>
                <a href="../index.php"><button
                        data-value=>Back
                </button></a>
            </header>

            <nav class="navbar" style="width:85%;">
                <a href="">
                    <div class="session-filter tag">Teacher</div>
                </a>
                <a href="">
                    <div class="session-filter day">Monday</div>
                </a>
                <a href="">
                    <div class="session-filter day">Tuesday</div>
                </a>
                <a href="">
                    <div class="session-filter day">Wednesday</div>
                </a>
                <a href="">
                    <div class="session-filter day">Thursday</div>
                </a>
                <a href="">
                    <div class="session-filter day">Friday</div>
                </a>
                <a href="">
                    <div class="session-filter remaining">Modify</div>
                </a>
            </nav>

            <div class="enrollment">
                <?php foreach ($free_mods as $teacher) {
                    $firstName = $teacher['usr_first_name'];
                    $lastName = $teacher['usr_last_name'];
                    ?>
                    <div class="session makeDefault">
                        <div class="tag"><?php echo $lastName ?>, <?php echo $firstName ?></div>
                        <div class="company">
                            <table>
                                <!--<thead>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                </thead>-->
                                <tbody>
                                    <tr>
                                        <td class="day">
                                            <?php echo $teacher['mon'] ?>
                                        </td>
                                        <td class="day">
                                            <?php echo $teacher['tues'] ?>
                                        </td>
                                        <td class="day">
                                            <?php echo $teacher['weds'] ?>
                                        </td>
                                        <td class="day">
                                            <?php echo $teacher['thurs'] ?>
                                        </td>
                                        <td class="day">
                                            <?php echo $teacher['fri'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="remaining" style="width: 5%; float: right; text-align: right">
                            <a style="color: #555" href="index.php?action=modify&usr_id=<?php echo $teacher['usr_id'] ?>"><h4 style="line-height: inherit">m</h4></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </body>
</html>