drop PROCEDURE `update_presentation_enrollment`;
CREATE PROCEDURE `update_presentation_enrollment`(IN `presId` INT)
    NO SQL
BEGIN

	update presentation
	set pres_enrolled_seats	= (
        select count(*)
		from pres_user_xref x, user u
		where pres_id = presId
        and x.usr_id = u.usr_id
        and usr_type_cde = 'STD'
		),
		pres_enrolled_teachers	= (
        select count(*)
		from pres_user_xref x, user u
		where pres_id = presId
        and x.usr_id = u.usr_id
        and usr_type_cde = 'TCH'
		)
	where pres_id = presId;
END