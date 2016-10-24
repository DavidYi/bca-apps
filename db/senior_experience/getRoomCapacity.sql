DROP FUNCTION IF EXISTS getRoomCapacity;
CREATE FUNCTION `getRoomCapacity`(rmId INT) RETURNS int(11)
BEGIN
	DECLARE rmCap int;

    DECLARE rm_cur cursor for
		SELECT rm_cap
        from room
		where rm_id = rmId;

	if (rmId = null) then
		return null;
	else
		open rm_cur;
        fetch rm_cur into rmCap;
        close rm_cur;
        return rmCap;
	end if;
END;