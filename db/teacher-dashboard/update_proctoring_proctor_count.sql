drop procedure `insert_user_test`;
CREATE PROCEDURE `insert_user_test`(IN testId INT)
BEGIN
update test_time_xref
	set proc_enrolled = (
        select count(*)
		from test_updt_xref x, user u
		where x.test_id = testId
        and x.test_time_id = test_time_xref.test_time_id
        and x.usr_id = u.usr_id
        and usr_type_cde = 'TCH'
		)
	where test_id = testId;
END