<?php

function get_test_list() {
    $query = 'SELECT test_id, test_name, rm_id, test.test_type_cde, test_dt, test_time_desc
                from test, test_type, test_time
                where test.test_type_cde = test_type.test_type_cde
                order by test.test_type_cde';
    return get_list($query);
}

?>
