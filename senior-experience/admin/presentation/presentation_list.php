<section>
    <h1>Presentation List</h1>
    <table class="gridtable">
        <tr>
            <th>Session Number</td>
    		<th>Title</td>
    		<th>Room Number</td>
    		<th>Students Enrolled</td>
            <th>Teachers Enrolled</td>
            <th>Modify</th>
        </tr>

    <?php foreach ($presentationList as $presentation) :
    // Get product data
    $sessionId = $presentation['ses_id'];
    $presentationTitle = $presentation['pres_title'];
    $presentationRoomNbr = $presentation['rm_nbr'];
    $students = $presentation['students'];
    $teachers = $presentation['teachers'];
    $pres_id = $presentation['pres_id'];
    ?>
    <tr>
        <td nowrap>
            <?php echo $sessionId; ?>
        </td>
        <td nowrap>
            <?php echo $presentationTitle; ?>
        </td>
        <td nowrap>
            <?php echo $presentationRoomNbr ?>
        </td>
        <td nowrap>
            <?php echo $students; ?>
        </td>
        <td no wrap>
            <?php echo $teachers; ?>
        </td>
        <td no wrap>
            <a href="index.php?action=show_modify_presentation&presentation_id=<?php echo $pres_id; ?>"><img src="../../images/modifyIcon.gif" title="Modify presentation" style="cursor:pointer"></a>
        </td>

    </tr>
<?php endforeach; ?>
</table>
</section>