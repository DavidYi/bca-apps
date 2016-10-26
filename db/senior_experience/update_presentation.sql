DROP PROCEDURE IF EXISTS update_presentation;
CREATE PROCEDURE `update_presentation`(IN presID INT,
																	IN presTitle VARCHAR(100),
																	IN presDesc VARCHAR(500),
																	IN presOrg VARCHAR(100),
																	IN presLoc VARCHAR(100),
																	IN usrID INT,
                                  IN fieldID INT,
                                  IN rmID INT,
                                  IN sesID INT,
                                  IN seniors VARCHAR(200))
    MODIFIES SQL DATA
BEGIN
	DECLARE v_finished int(10) default 0;
	DECLARE presID INT;
    DECLARE pos INT;
    DECLARE seniorID INT;
    DECLARE snrs VARCHAR(100);
	DECLARE procName VARCHAR(100) default 'update_presentation';

	DECLARE user_cur cursor for
		SELECT x.usr_id
        from user u
		inner join user_presentation_xref x on u.usr_id = x.usr_id
		where x.pres_id = presID
		and u.usr_id in (seniors)
        and x.usr_id is null;


    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        get diagnostics condition 1
          @p1 = MESSAGE_TEXT;

		call log_error_message (concat('sql err msg:',@p1),  procName);
		commit;

#        set result = @p1;
    END;

    -- declare NOT FOUND handler
    DECLARE CONTINUE HANDLER
    FOR NOT FOUND SET v_finished = 1;

	call log_trace_message (concat('About to update ', presID),  procName);
	commit;

	update presentation
    set ses_id = sesId,
		rm_id = rmID,
        field_id = fieldID,
        pres_title = presTitle,
        pres_desc = presDesc,
        organization = presOrg,
        location = presLoc
	where pres_id = presID;

	call log_trace_message ('updated',  procName);
	commit;

	set seniors = concat(seniors, usrID);

	call log_trace_message (concat('seniors:',seniors),  procName);
	commit;

	delete from user_presentation_xref
    where usr_id not in (seniors)
    and pres_id = presID;

	call log_trace_message ('deleted extra seniors',  procName);
	commit;


    open user_cur;
	user_loop: LOOP
		FETCH user_cur INTO seniorID;

		call log_trace_message (concat('adding seniorID:',seniorID),  procName);
		commit;

        IF v_finished = 1 THEN
			LEAVE user_loop;
		END IF;

		insert into user_presentation_xref (usr_id, pres_id, presenting, user_pres_updt_usr_id)
		values (seniorID, presID, 1, usrID);

	END LOOP user_loop;

    close user_cur;

	call log_trace_message ('exitting',  procName);
    commit;

END;