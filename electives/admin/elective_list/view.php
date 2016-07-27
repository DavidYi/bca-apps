<html>
    <head>
        <link rel="stylesheet" href="../css/main.css">
        <style>
            button {
                background-color: #ffcc00;
                position: absolute;
                height: 80px;
                width: 120px;
                font-size: 20px;
            }

            #add_button {
                right:15%;
                line-height: 1.5em;
            }

            #back_button {
                left: 15%
            }
        </style>
    </head>
    <body>
        <div class="main">
            <header>
                <h1 class="title">Elective List</h1>

                <a href="./index.php?action=add">
                    <button type="submit" id="add_button">Add Elective</button>
                </a>

                <a href="../index.php">
                    <button type="submit" id="back_button">Back</button>
                </a>
            </header>
        </div>

    </body>
</html>