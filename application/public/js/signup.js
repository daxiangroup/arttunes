$(document).ready(function() {
    $('#signup-type-1, #signup-type-2').click(function() {
        toggle_creator();
    })

    toggle_creator();
});

function toggle_creator() {
    if ($('#signup-type-1').attr('checked')) {
        $('#cntr-signup .cntr-signup-creator').hide();
    }

    if ($('#signup-type-2').attr('checked')) {
        $('#cntr-signup .cntr-signup-creator').show();
    }
}