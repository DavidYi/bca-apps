DROP PROCEDURE IF EXISTS update_presentation_enroll_counts;
CREATE PROCEDURE `update_presentation_enroll_counts`(IN presId INT)
BEGIN
	update presentation
	set pres_enrolled_students	= (
        select count(*)
		from user_presentation_xref x, user u
		where pres_id = presId
        and x.usr_id = u.usr_id
        and presenting = 0
        and usr_type_cde = 'STD'
		),
        pres_enrolled_teachers= (
        select count(*)
		from user_presentation_xref x, user u
		where pres_id = presId
        and x.usr_id = u.usr_id
        and presenting = 0
        and usr_type_cde = 'TCH'
		)
	where pres_id = presId;
END;