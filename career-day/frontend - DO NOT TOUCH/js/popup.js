/**
 * Created by nicolettetovstashy on 4/6/16.
 */
$(document).ready(function() {
    console.log('test');
    $('.presenter').click(function() {
        $('.popup-bg, .popup').css('display','block');
    });
    $('.close').click(function() {
        $('.popup-bg, .popup').css('display','none');
    });
});