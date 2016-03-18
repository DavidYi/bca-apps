<html>

<?php sizeof($logs); ?>

<link rel="stylesheet" type="text/css" href="../css/mentor_list.css">

<html>

<section>
    <h1>Log Viewer</h1>
    <table class="gridtable">


        <tr class="tablerow">
            <th>Date/Time </th>
            <th>Lvl. </th>
            <th>Name </th>
            <th>Message </th>

        </>

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
