drop PROCEDURE `update_presentation_enrollment`;
CREATE PROCEDURE `update_presentation_enrollment`(IN `presId` INT)
    NO SQL
BEGIN

	update presentation
	set pres_enrolled_count	= (
        select count(*) 
		from pres_user_xref
		where pres_id = presId
		)
	where pres_id = presId;
END