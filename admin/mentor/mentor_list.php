
    <script type="text/javascript">
        function deleteTeacher(mentorID)
        {
            if (confirm('Are you sure you would like to delete the mentor?'))
            {
                window.parent.parent.location.href = 'view.php?action=delete_mentor&mentor_id=' + mentorID;
            }
        }

    </script>
    <section>
        <h1>Teachers List</h1>
        < class="grid">

            <a href="view.php?action=show_add_mentor">Add New Mentor</a>
            <tr>
                <th>Mentor ID </th>
                <th>Last Name </th>
                <th>First Name </th>
                <th>Field</th>
                <th>Company</th>
                <th>Position</th>
                <th>Room</th>
                <th>Max Capacity</th>
                <th>Modify</th>


            </tr>

            <?php foreach ($mentorList as $mentor) :

                $mentorId = $mentor['mentor_id'];
                $mentor_last_name = $mentor['mentor_last_name'];
                $mentor_first_name = $mentor['mentor_first_name'];
                $mentor_position = $mentor['mentor_position'];
                $mentor_company = $mentor['mentor_company'];

                $mentor_position = $mentor['display_name'];


                ?>
                <tr>
                    <td nowrap>
                        <?php echo $teacherId; ?>
                    </td>
                    <td nowrap>
                        <?php echo $lastName; ?>
                    </td>
                    <td nowrap>
                        <?php echo $firstName; ?>
                    </td>
                    <td nowrap>
                        <?php echo $displayName; ?>
                    </td>

                    <td no wrap>
                        <a href="index.php?action=show_modify_teacher&teacher_id=<?php echo $teacherId; ?>"><img src="../../images/modifyIcon.gif" title="Modify Teacher" style="cursor:pointer"></a>
                        <img src="../../images/deleteIcon.gif" onClick="deleteTeacher(<?php echo $teacherId; ?>);" title="Delete Teacher" style="cursor:pointer">
                    </td>

                </tr>
            <?php endforeach; ?>
        </>
    </section>
<?php include '../../view/footer.php'; ?>