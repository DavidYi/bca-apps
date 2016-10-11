DROP FUNCTION IF EXISTS userHasSession;
CREATE FUNCTION `userHasSession`(`usrId` INT, `sesId` INT) RETURNS tinyint(1)
    READS SQL DATA
BEGIN
	declare v_count int;

    declare cur cursor for
		SELECT count(*)
        from presentation p, user_presentation_xref x
        where x.pres_id = p.pres_id
		and ses_id = sesId
		and usr_id = usrId;

    open cur;
    FETCH cur INTO v_count;
	close cur;

	if (v_count = 0) then
		return FALSE;
	else
		return TRUE;
	end if;
END;