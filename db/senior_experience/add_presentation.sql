DROP PROCEDURE IF EXISTS add_presentation;
CREATE PROCEDURE `add_presentation`(IN presTitle VARCHAR(100),
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
	DECLARE presID INT;
    DECLARE pos INT;
    DECLARE seniorID INT;
    DECLARE snrs VARCHAR(100);

	insert into presentation (ses_id, rm_id, field_id, pres_title, pres_desc, organization, location)
	values (sesId, rmID, fieldID, presTitle, presDesc, presOrg, presLoc);

	set presID = last_insert_id();

	insert into user_presentation_xref (usr_id, pres_id, presenting, user_pres_updt_usr_id)
    values (usrID, presID, 1, usrID);

    set pos = INSTR (seniors, ',');
    call log_trace_message(concat ('seniors:', seniors), 'add_presentation');
    call log_trace_message(concat ('pos:', pos), 'add_presentation');

    while pos > 0 do
		set seniorID = SUBSTR(seniors, 1, pos-1);
		call log_trace_message(concat ('seniorID:', seniorID), 'add_presentation');

		insert into user_presentation_xref (usr_id, pres_id, presenting, user_pres_updt_usr_id)
		values (seniorID, presID, 1, usrID);

        set seniors = SUBSTR(seniors, pos+1);
        set pos = INSTR(seniors, ',');

		call log_trace_message(concat ('seniors:', seniors), 'add_presentation');
		call log_trace_message(concat ('pos:', pos), 'add_presentation');
	end while;

END;