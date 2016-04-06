
<script type="text/javascript">
	function deleteTest(testId){
		if(confirm('Are you sure you want to delete this test?')){
			window.parent.parent.location.href =
				'index.php?action=delete_test&test_id=' + testId;
		}
	}

</script>
<section>
	<h1>Proctoring Session List</h1>
	<table class="gridtable">
	<a href="index.php?action=sign_up">Sign Up to Proctor</a>

	<tr>
		<th>Test Name </th>
		<th>Test Type </th>
		<th>Room </th>
		<th>Time </th>
		<th>Actions </th>
	</tr>

	<?php foreach ($testList as $test) :
		$testId = $test['test_id'];
		$testType = $test['test_type_cde'];
		$testName = $test['test_name'];
		$roomId = $test['rm_id'];
		$testDate = $test['test_dt'];
	?>
		<tr>
			<td nowrap><?php echo $testName; ?></td>
			<td nowrap><?php echo $testType; ?></td>
			<td nowrap><?php echo $roomId; ?></td>
			<td nowrap><?php echo $testDate; ?></td>

				<img src="../../images/deleteIcon.gif"
					 onclick="deleteCourse(<?php echo $testId; ?>);"
					 title="Delete Test"
					 style="cursor:pointer">
			</td>

		</tr>
	<?php endforeach; ?>
	</table>
</section>

	<?php if ($registrationOpen || isset($_SESSION['prev_usr_id'])) {?>
					<?php } ?>

		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
		<script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
		<script type="text/javascript">
		    $('body').plusAnchor({
		        easing: 'easeInOutExpo',
		        speed:  700
		    });
		</script>
	</body>
</html>