DROP TRIGGER IF EXISTS test_updt_xref_AFTER_DELETE;
CREATE TRIGGER `test_updt_xref_AFTER_DELETE` AFTER DELETE ON `test_updt_xref`
 FOR EACH ROW BEGIN
 call update_proctoring_proctor_count (old.test_id);
END;

DROP TRIGGER IF EXISTS `test_updt_xref_AFTER_INSERT`;
CREATE TRIGGER `test_updt_xref_AFTER_INSERT` AFTER INSERT ON `test_updt_xref`
 FOR EACH ROW BEGIN
 call update_proctoring_proctor_count (new.test_id);
END;

DROP TRIGGER IF EXISTS `test_updt_xref_AFTER_UPDATE`;
CREATE TRIGGER `test_updt_xref_AFTER_UPDATE` AFTER UPDATE ON `test_updt_xref`
 FOR EACH ROW BEGIN
 call update_proctoring_proctor_count (new.test_id);
END;
