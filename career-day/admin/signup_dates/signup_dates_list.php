
    <script type="text/javascript">
        function deletesignup_dates(classYear)
        {
            if (confirm('Are you sure you would like to delete the sign up date??'))
            {
                window.parent.parent.location.href = 'index.php?action=delete_signup_dates&class_year=' + classYear;
            }
        }
    </script>

    <section>
        <h1>Career Day Sign Up Dates:</h1>
        <table class="gridtable">

            <a href="index.php?action=show_add_signup_dates">Add New Sign Up Date</a>
            <tr>
                <th>Class Year </td>
                <th>Start </td>
                <th>End </td>
            </tr>

            <?php foreach ($signup_datesList as $signup_dates) :
                // Get product data
                $classYear = $signup_dates['class_year'];
                $start = $signup_dates['start'];
                $end = $signup_dates['end'];
                ?>
                <tr>
                    <td nowrap>
                        <?php echo $classYear; ?>
                    </td>
                    <td nowrap>
                        <?php echo $start; ?>
                    </td>
                    <td nowrap>
                        <?php echo $end; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
<?php include 'view/footer.php'; ?>