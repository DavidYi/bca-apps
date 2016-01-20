<script type="text/javascript">
        function deleteMentor(mentorID)
        {
            if (confirm('Are you sure you would like to delete the mentor?'))
            {
                window.parent.parent.location.href = 'view.php?action=delete_mentor&mentor_id=' + mentorID;
            }
        }

    </script>

<link rel="stylesheet" type="text/css" href="../css/mentor_list.css">

    <section>
        <h1>Mentor List</h1>
        <table class="gridtable">

            <a href="index.php?action=show_add_mentor">Add New Mentor</a>
            <tr class="tablerow">
                <th>Last Name </th>
                <th>First Name </th>
                <th>Company</th>
                <th>Room</th>
                <th>Position</th>
                <th>Host Teacher</th>
                <th>Max Capacity</th>



            </tr>

            <?php foreach ($mentorList as $mentor) :

                $mentorId = $mentor['mentor_id'];
                $mentor_last_name = $mentor['mentor_last_name'];
                $mentor_first_name = $mentor['mentor_first_name'];
                $mentor_position = $mentor['mentor_position'];
                $mentor_company = $mentor['mentor_company'];
                $pres_room = $mentor['pres_room'];
                $pres_host_teacher = $mentor['pres_host_teacher'];
                $pres_max_capacity = $mentor['pres_max_capacity'];

                ?>

                <tr class="clicky" onclick="modify(<?php echo($mentorId)?>);">


                    <td nowrap>
                        <?php echo $mentor_last_name; ?>
                    </td>

                    <td nowrap>
                        <?php echo $mentor_first_name; ?>
                    </td>

                    <td>
                        <?php echo $mentor_company; ?>
                    </td>

                    <td >
                        <?php echo $pres_room; ?>
                    </td>

                    <td >
                        <?php echo $mentor_position; ?>
                    </td>
                    <td >
                        <?php echo $pres_host_teacher; ?>
                    </td>

                    <td >
                        <?php echo $pres_max_capacity; ?>
                    </td>







                </tr>
            <?php endforeach; ?>
        </table>
    </section>

<script>function modify($mentorId){
        window.parent.parent.location.href="index.php?action=show_modify_mentor&mentor_id=" + $mentorId;
    }
</script>