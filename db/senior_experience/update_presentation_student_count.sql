DROP PROCEDURE IF EXISTS update_presentation_student_count;
CREATE PROCEDURE `update_presentation_student_count`(IN presId INT)
BEGIN
	update presentation
	set pres_enrolled_students	= (
        select count(*)
		from user_presentation_xref x, user u
		where pres_id = presId
        and x.usr_id = u.usr_id
        and usr_type_cde = 'STD'
        and presenting = 0
		)
	where pres_id = presId;
END;