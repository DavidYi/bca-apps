drop FUNCTION `userHasSession`;
CREATE FUNCTION `userHasSession`(`usrId` INT, `sesId` INT) RETURNS tinyint(1)
    READS SQL DATA
BEGIN
	declare v_count int;

    declare cur cursor for
		SELECT count(*)
        from presentation
		inner join pres_user_xref on pres_user_xref.pres_id = presentation.pres_id
		where ses_id = sesId
		and usr_id = usrId;

    open cur;
    FETCH cur INTO v_count;
	close cur;

	if (v_count = 0) then
		return FALSE;
	else
		return TRUE;
	end if;
END