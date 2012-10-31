$(document).ready(function() {
    $('#cntr-profile .cntr-display .icon-pencil').each(function() {
        $(this).click(function() {
            $('#cntr-profile .cntr-display').each(function() { $(this).show(); });
            $('#cntr-profile .cntr-edit').each(function() { $(this).hide(); });

            var row = $(this).closest('.row');
            var id = '#' + row.attr('id');

            $(id + ' .cntr-display').hide();
            $(id + ' .cntr-edit').show();
        });
    });
});