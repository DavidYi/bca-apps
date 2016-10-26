
DROP VIEW IF EXISTS user;
CREATE VIEW user AS SELECT * FROM bryres_shared.user;

DROP VIEW IF EXISTS user_type;
CREATE VIEW user_type AS SELECT * FROM bryres_shared.user_type;

DROP VIEW IF EXISTS user_role;
CREATE VIEW user_role AS SELECT * FROM bryres_shared.user_role;

DROP VIEW IF EXISTS log_lvl;
CREATE VIEW log_lvl AS SELECT * FROM bryres_shared.log_lvl;

DROP VIEW IF EXISTS log;
CREATE VIEW log AS SELECT * FROM bryres_shared.log;

DROP VIEW IF EXISTS application;
CREATE VIEW application AS SELECT * FROM bryres_shared.application;

DROP VIEW IF EXISTS role_application_user_xref;
CREATE VIEW role_application_user_xref AS SELECT * FROM bryres_shared.role_application_user_xref;