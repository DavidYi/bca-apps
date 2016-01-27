SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

DELIMITER $$

DROP PROCEDURE IF EXISTS `fill_with_random_presentations`$$
CREATE DEFINER=`atcsdevb_caradm`@`%` PROCEDURE `fill_with_random_presentations`(IN `gradeLvl` INT, IN `sesId` INT)
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
END$$

DROP PROCEDURE IF EXISTS `log_error_message`$$
CREATE DEFINER=`atcsdevb_caradm`@`%` PROCEDURE `log_error_message`(IN `message` VARCHAR(1000), IN `method` INT(100))
    MODIFIES SQL DATA
BEGIN
	insert into log (log_lvl_cde, log_msg, log_src, log_mthd)
	values ('ERR', message, 'STORED PROCEDURE', method);
END$$

DROP PROCEDURE IF EXISTS `log_trace_message`$$
CREATE DEFINER=`atcsdevb_caradm`@`%` PROCEDURE `log_trace_message`(IN `message` VARCHAR(1000), IN `method` VARCHAR(100))
    MODIFIES SQL DATA
BEGIN
	insert into log (log_lvl_cde, log_msg, log_src, log_mthd)
	values ('TRC', message, 'STORED PROCEDURE', method);
END$$


DROP PROCEDURE IF EXISTS `update_presentation_enrollment`$$
CREATE DEFINER=`atcsdevb_caradm`@`%` PROCEDURE `update_presentation_enrollment`(IN `presId` INT)
    NO SQL
BEGIN

	update presentation
	set pres_enrolled_count	= (
        select count(*) 
		from pres_user_xref
		where pres_id = presId
		)
	where pres_id = presId;
END$$


DROP FUNCTION IF EXISTS `get_session_comma_list`$$
CREATE DEFINER=`atcsdevb_caradm`@`%` FUNCTION `get_session_comma_list`(`ment_id` INT) RETURNS varchar(20) CHARSET latin1
    READS SQL DATA
BEGIN
    declare output varchar(500) default "";
	declare v_finished int(10) default 0;
	DECLARE v_time varchar(100) DEFAULT "";

    declare cur cursor for   
		SELECT ses_id
        from presentation
		where mentor_id = ment_id;

    -- declare NOT FOUND handler
    DECLARE CONTINUE HANDLER 
    FOR NOT FOUND SET v_finished = 1;

    open cur;

    get_list: LOOP
     FETCH cur INTO v_time;
     IF v_finished = 1 THEN 
	     LEAVE get_list;
     END IF;
    
-- build email list
	if output = '' then
		set output = v_time;
	else
     SET output = CONCAT(output,", ",v_time);
	end if;

    END LOOP get_list;
	
	close cur;
	
	return output;
END$$



DROP FUNCTION IF EXISTS `userHasSession`$$
CREATE DEFINER=`atcsdevb_caradm`@`%` FUNCTION `userHasSession`(`usrId` INT, `sesId` INT) RETURNS tinyint(1)
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
END$$

DROP TRIGGER IF EXISTS `TRIG_AFTER_PRES_USER_XREF_DELETE`$$
CREATE TRIGGER `TRIG_AFTER_PRES_USER_XREF_DELETE` AFTER DELETE ON `pres_user_xref`
 FOR EACH ROW begin 
call update_presentation_enrollment (old.pres_id);
END
$$

DROP TRIGGER IF EXISTS `TRIG_AFTER_PRES_USER_XREF_INSERT`$$
CREATE TRIGGER `TRIG_AFTER_PRES_USER_XREF_INSERT` AFTER INSERT ON `pres_user_xref`
 FOR EACH ROW begin 
call update_presentation_enrollment (new.pres_id);
END
$$

DROP TRIGGER IF EXISTS `TRIG_AFTER_PRES_USER_XREF_UPDATE`$$
CREATE TRIGGER `TRIG_AFTER_PRES_USER_XREF_UPDATE` AFTER UPDATE ON `pres_user_xref`
 FOR EACH ROW begin 
call update_presentation_enrollment (new.pres_id);
END
$$


DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
