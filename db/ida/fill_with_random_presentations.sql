DROP PROCEDURE IF EXISTS fill_with_random_presentations;

CREATE PROCEDURE `fill_with_random_presentations`(IN `gradeLvl` INT(11))
    MODIFIES SQL DATA
BEGIN
	DECLARE v_finished int(10) default 0;
	DECLARE userId int;
	DECLARE sesId int;
	DECLARE presId int;
	DECLARE num int;
	DECLARE maxStudents int(4) default 1000;
    DECLARE rownumber int default 0;
	DECLARE procName VARCHAR(100) default 'fill_with_random_presentations';

    DECLARE student_cur cursor for
		SELECT usr_id, ses_id
        from user, session_times
		where usr_grade_lvl = gradeLvl
		and userHasSession (user.usr_id, session_times.ses_id) = FALSE
		limit maxStudents;

	DECLARE pres_cur cursor for
		select pres_id, (pres_max_seats - pres_enrolled_seats) as remaining
		from presentation
		where pres_enrolled_seats < pres_max_seats
		and pres_permit_auto_enroll = 1
		and ses_id = sesId
		and pres_id not in (
            select pres_id
            from pres_user_xref
            where usr_id = userId
        )
        order by remaining desc
        limit 1;

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

	call log_trace_message (concat('entering proc; gradelev:',gradeLvl), procName);
	commit;

    open student_cur;

	commit;

	student_loop: LOOP
		 FETCH student_cur INTO userId, sesId;

         IF v_finished = 1 THEN
			call log_trace_message ('last student', procName);
			commit;
             LEAVE student_loop;
         END IF;

		 open pres_cur;
         FETCH pres_cur INTO presId, num;
		 close pres_cur;

        call log_trace_message (concat('adding user ', userId, ' to pres ', presId , ' for session ', sesId), procName);
        commit;


		insert into pres_user_xref (pres_id, usr_id, pres_user_updt_usr_id)
        values (presId, userId, -1);
        commit;

		set rownumber = rownumber + 1;

    END LOOP student_loop;

	call log_trace_message (CONCAT('exiting; updated: ', rownumber), procName);
  close student_cur;
END;