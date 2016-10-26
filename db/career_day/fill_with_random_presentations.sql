drop procedure `fill_with_random_presentations`;
CREATE PROCEDURE `fill_with_random_presentations`(IN `gradeLvl` INT, IN `sesId` INT)
    MODIFIES SQL DATA
BEGIN
	DECLARE v_finished int(10) default 0;
	DECLARE userId int;
	DECLARE presId int;
	DECLARE num int;
	DECLARE procName VARCHAR(100) default 'fill_with_random_presentations';

    DECLARE student_cur cursor for   		
		SELECT usr_id
        from user
		inner join signup_dates on user.usr_class_year = signup_dates.class_year
		inner join session_times
		where grade_lvl = gradeLvl
		and ses_id = sesId
		and userHasSession (user.usr_id, sesId) = FALSE;

	DECLARE pres_cur cursor for 
		select pres_id, (mentor.pres_max_capacity - pres_enrolled_count) as remaining
		from presentation
		inner join mentor on mentor.mentor_id = presentation.mentor_id
		where pres_enrolled_count < mentor.pres_max_capacity
		and ses_id = sesId
		order by remaining DESC;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        get diagnostics condition 1
          @p1 = MESSAGE_TEXT;

		call log_error_message (concat('sql err msg:',@p1),  procName);
		commit;

        SELECT @p1;
    END;
		
    -- declare NOT FOUND handler
    DECLARE CONTINUE HANDLER 
    FOR NOT FOUND SET v_finished = 1;

	call log_trace_message (concat('entering proc; gradelev:',gradeLvl, '; sesId:', sesId)  , procName);
	commit;

	open pres_cur;
    open student_cur;

	commit;

	student_loop: LOOP
		 FETCH student_cur INTO userId;
		
		call log_trace_message (concat('userId:', userId), procName);
		commit;

         IF v_finished = 1 THEN 
			call log_trace_message ('last student', procName);
			commit;
             LEAVE student_loop;
         END IF;

         FETCH pres_cur INTO presId, num;

		call log_trace_message (concat('presId:', presId), procName);
			commit;

		IF v_finished = 1 THEN 
			call log_trace_message ('last presentation, requery', procName);
            close pres_cur;
            open pres_cur;
            set v_finished = 0;
            FETCH pres_cur INTO presId, num;
         END IF;

		insert into pres_user_xref (pres_id, usr_id, pres_user_updt_usr_id)
        values (presId, userId, -1);
        commit;

    END LOOP student_loop;

	call log_trace_message ('exiting', procName);

	close pres_cur;
    close student_cur;
END