
--
-- Structure for view `application`
--
-- drop view application;
CREATE ALGORITHM=UNDEFINED VIEW `application` AS select `application`.`app_cde` AS `app_cde`,`application`.`app_name` AS `app_name`,`application`.`app_desc` AS `app_desc` from `bryres_shared`.`application`;

-- --------------------------------------------------------

--
-- Structure for view `log`
--
-- drop view log;
CREATE ALGORITHM=UNDEFINED VIEW `log` AS select `log`.`log_id` AS `log_id`,`log`.`log_lvl_cde` AS `log_lvl_cde`,`log`.`log_msg` AS `log_msg`,`log`.`log_src` AS `log_src`,`log`.`log_mthd` AS `log_mthd`,`log`.`log_dt` AS `log_dt`,`log`.`usr_id` AS `usr_id`,`log`.`log_pdo_msg` AS `log_pdo_msg`,`log`.`log_pdo_code` AS `log_pdo_code`,`log`.`log_pdo_file` AS `log_pdo_file`,`log`.`log_pdo_line` AS `log_pdo_line`,`log`.`app_cde` AS `app_cde` from `bryres_shared`.`log`;

-- --------------------------------------------------------

--
-- Structure for view `log_lvl`
--
-- drop view log_lvl;
CREATE ALGORITHM=UNDEFINED VIEW `log_lvl` AS select `log_lvl`.`log_lvl_vde` AS `log_lvl_vde`,`log_lvl`.`log_lvl_desc` AS `log_lvl_desc` from `bryres_shared`.`log_lvl`;

-- --------------------------------------------------------

--
-- Structure for view `role_application_user_xref`
--
-- drop view role_application_user_xref;
CREATE ALGORITHM=UNDEFINED VIEW `role_application_user_xref` AS select `role_application_user_xref`.`app_cde` AS `app_cde`,`role_application_user_xref`.`usr_id` AS `usr_id`,`role_application_user_xref`.`usr_role_cde` AS `usr_role_cde` from `bryres_shared`.`role_application_user_xref`;

-- --------------------------------------------------------

--
-- Structure for view `user`
--
-- drop view user;
CREATE ALGORITHM=UNDEFINED VIEW `user` AS select `user`.`usr_id` AS `usr_id`,`user`.`usr_first_name` AS `usr_first_name`,`user`.`usr_last_name` AS `usr_last_name`,`user`.`usr_display_name` AS `usr_display_name`,`user`.`usr_grade_lvl` AS `usr_grade_lvl`,`user`.`usr_bca_id` AS `usr_bca_id`,`user`.`user_email` AS `user_email`,`user`.`usr_type_cde` AS `usr_type_cde`,`user`.`usr_class_year` AS `usr_class_year`,`user`.`academy_cde` AS `academy_cde`,`user`.`ps_id` AS `ps_id`,`user`.`usr_active` AS `usr_active` from `bryres_shared`.`user`;

-- --------------------------------------------------------

--
-- Structure for view `user_role`
--
-- drop view user_role;
CREATE ALGORITHM=UNDEFINED VIEW `user_role` AS select `user_role`.`usr_role_cde` AS `usr_role_cde`,`user_role`.`usr_role_desc` AS `usr_role_desc` from `bryres_shared`.`user_role`;

-- --------------------------------------------------------

--
-- Structure for view `user_type`
--
-- drop view user_type;
CREATE ALGORITHM=UNDEFINED VIEW `user_type` AS select `user_type`.`usr_type_cde` AS `usr_type_cde`,`user_type`.`usr_type_desc` AS `usr_type_desc` from `bryres_shared`.`user_type`;

