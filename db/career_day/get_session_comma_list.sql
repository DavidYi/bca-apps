drop function `get_session_comma_list`;
CREATE FUNCTION `get_session_comma_list`(`ment_id` INT) RETURNS varchar(20) CHARSET latin1
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
END