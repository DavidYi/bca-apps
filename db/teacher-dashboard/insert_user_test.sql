drop procedure `insert_user_test`;

CREATE PROCEDURE `insert_user_test`(IN testId INT,
IN testTimeId INT, IN usrId INT, IN testDate TIMESTAMP, IN updtUsrId INT)
    MODIFIES SQL DATA
BEGIN
  DECLARE cnt INT;

  select count(*) into cnt
      from test_updt_xref x, test_time_xref t
        where x.test_id = testId
            and x.test_time_id = testTimeId
            and x.usr_id = usrId;
  if (cnt = 0) then
    insert into test_updt_xref (test_id, test_time_id, usr_id, updt_dt, updt_usr_id)
          values (testId, testTimeId, usrId, testDate, updtUsrId);
  end if;
end