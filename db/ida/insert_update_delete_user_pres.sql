DROP PROCEDURE IF EXISTS insert_update_delete_user_pres;

CREATE PROCEDURE `insert_update_delete_user_pres`(IN presId INT,
												IN usrId INT,
                                                IN sesId INT,
                                                IN updtUsrId INT)
    MODIFIES SQL DATA
BEGIN
    DECLARE cnt INT;

	if (presId is null) then
		delete from pres_user_xref
        where pres_id in (select pres_id from presentation where ses_id = sesId)
        and usr_id = usrId;

    else
		select count(*) into cnt
        from pres_user_xref x, presentation p
		where x.pres_id = p.pres_id
        and p.ses_id = sesId
        and x.usr_id = usrId;

        if (cnt > 0) then
			update pres_user_xref
            set pres_id = presID, pres_user_updt_usr_id = updtUsrId
            where usr_id = usrId
			and pres_id in (select pres_id
							from presentation
							where ses_id = sesId
							and pres_id != presId);
		else
			insert into pres_user_xref (pres_id, usr_id, pres_user_updt_usr_id)
            values (presId, usrId, updtUsrId);
		end if;
	end if;
end;