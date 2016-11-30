<?php
/**
 * Created by PhpStorm.
 * User: celinaperalta
 * Date: 11/30/16
 * Time: 10:05
 */

$value = strtolower(filter_input(INPUT_POST, 'value'));

?>


<html>


<script type="text/javascript">


    function listPDF(value) {

        $("input[name='test_id']").val(value);
        document.forms['test'].submit();

    }

    $(document).ready(function () {
        listPDF();
    });


</script>
</html>
