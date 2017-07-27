$(document).ready(load_masks);

function load_masks() {
    $('.mask_date').mask('00/00/0000', {clearIfNotMatch: true});
    $('.mask_hour').mask('00:00', {clearIfNotMatch: true});
    $('.mask_phone').mask('(99) 9999?9-9999');
    $('.mask_phone').on('blur', function () {
        var last = $(this).val().substr($(this).val().indexOf("-") + 1);

        if (last.length === 3) {
            var move = $(this).val().substr($(this).val().indexOf("-") - 1, 1);
            var lastfour = move + last;

            var first = $(this).val().substr(0, 9);

            $(this).val(first + '-' + lastfour);
        }
    });
    $('.mask_cpf').mask('999.999.999-99');
}