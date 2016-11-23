drop procedure `update_proctoring_proctor_count`;

CREATE PROCEDURE `update_proctoring_proctor_count`(IN testId INT)
BEGIN
update test_time_xref
	set proc_enrolled = (
        select count(*) 
		from test_updt_xref x, user u
		where x.test_id = testId
        and x.test_time_id = test_time_xref.test_time_id
        and x.usr_id = u.usr_id
		)
	where test_id = testId; 
END