
$('#submit').attr('disabled', true);
$('#comment').change(function () {
    if ($('#comment').val() != '') {
        $('#submit').attr('disabled', false);
    } else {
        $('#submit').attr('disabled', true);
    }
});

