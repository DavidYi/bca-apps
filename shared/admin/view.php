<html>
    <head>
        <title>Log Viewer</title>
    </head>

    <body>
        <?php foreach ($logs as $log) { ?>
            <?php echo $log['log_msg'] ?> <BR>
        <?php } ?>
    </body>
</html>