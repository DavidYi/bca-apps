
DROP VIEW IF EXISTS user;
CREATE VIEW user AS SELECT * FROM atcsdevb_shared.user;

DROP VIEW IF EXISTS user_type;
CREATE VIEW user_type AS SELECT * FROM atcsdevb_shared.user_type;

DROP VIEW IF EXISTS user_role;
CREATE VIEW user_role AS SELECT * FROM atcsdevb_shared.user_role;

DROP VIEW IF EXISTS log_lvl;
CREATE VIEW log_lvl AS SELECT * FROM atcsdevb_shared.log_lvl;

DROP VIEW IF EXISTS log;
CREATE VIEW log AS SELECT * FROM atcsdevb_shared.log;

DROP VIEW IF EXISTS application;
CREATE VIEW application AS SELECT * FROM atcsdevb_shared.application;

DROP VIEW IF EXISTS role_application_user_xref;
CREATE VIEW role_application_user_xref AS SELECT * FROM atcsdevb_shared.role_application_user_xref;