drop procedure `log_error_message`;
CREATE PROCEDURE `log_error_message`(IN `message` VARCHAR(1000), IN `method` VARCHAR(100))
    MODIFIES SQL DATA
BEGIN
	insert into log (log_lvl_cde, log_msg, log_src, log_mthd, app_cde)
	values ('ERR', message, 'STORED PROCEDURE', method, 'IDA');
END