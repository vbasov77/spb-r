$(document).ready(function () {
    var element = $('.chart');
    $counter = 0;
    $(window). scroll(function () {
        var scroll = $(window).scrollTop() + $(window).height();
        var offset = element.offset().top + element.height();
        if(scroll > offset && $counter == 0){

            $('.progressBar').each(function () {
                var bar = $(this);
                var maxvalue = $(this).attr('data');
                maxvalue = 0;
                var text = $(this).children('div').data('show');
                progress1(maxvalue, bar, text);
            });

            $('.progressBar').each(function () {
                var bar = $(this);
                var maxvalue = $(this).attr('data');
                maxvalue = maxvalue.substring(3);
                var text = $(this).children('div').data('show');
                progress(maxvalue, bar, text);
            });
            $counter = 1;
        }


    })

});

function progress1(percent, element, text) {
    element.find('div').animate({width: percent + '%'}, 1).html(text + "&nbsp;" + percent + "%&nbsp;");
}

function progress(percent, element, text) {
    element.find('div').animate({width: percent + '%'}, 1000).html(text + "&nbsp;" + percent + "%&nbsp;");
}
