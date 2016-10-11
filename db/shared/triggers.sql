CREATE or REPLACE TRIGGER user_BEFORE_INSERT BEFORE INSERT ON user FOR EACH ROW
BEGIN
if ((new.usr_type_cde = 'STD') and (new.usr_class_year is not null)) then
		set new.usr_grade_lvl = 12 + (2017-new.usr_class_year);
    end if;
    
	if (new.usr_type_cde = 'TCH') then
		set new.usr_grade_lvl = 13;
    end if;
END;

CREATE or REPLACE TRIGGER `user_BEFORE_UPDATE` BEFORE UPDATE ON `user` FOR EACH ROW
BEGIN
	if ((new.usr_type_cde = 'STD') and (new.usr_class_year is not null)) then
		set new.usr_grade_lvl = 12 + (2017-new.usr_class_year);
    end if;
    
	if (new.usr_type_cde = 'TCH') then
		set new.usr_grade_lvl = 13;
    end if;
END;
