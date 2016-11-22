/**
 * Created by David
 */

function listPDF(value) {
    $("input[name='test_id']").val(value);
    document.forms['test'].submit();
}