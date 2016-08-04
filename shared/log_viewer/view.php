<html>
<title>Log Viewer</title>

<link rel="stylesheet" type="text/css" href="../../../shared/ss/main.css">
<link rel="stylesheet" type="text/css" href="../../../shared/log_viewer/styles.css">

<html>

<section style="margin:5em;padding:0;">
    <h1>Log Viewer</h1>
    <table class="gridtable" style="width:50%;">



        <tr class="tablerow">
            <th>Date/Time </th>
            <th>Lvl. </th>
            <th>Name </th>
            <th>Message </th>

        </tr>

        <?php foreach ($logs as $log) :
        // Get product data
        $logDate = $log['log_dt'];
        $logLvl = $log['log_lvl_cde'];
        $logMsg = $log['log_msg'];
        $logName = $log['name'];

        ?>
        <tr>
            <td nowrap><?php echo $logDate; ?></td>
            <td nowrap><?php echo $logLvl; ?></td>
            <td nowrap><?php echo $logName; ?></td>
            <td nowrap><?php echo $logMsg; ?></td>



            <?php endforeach; ?>
    </table>
</section>

</html>
