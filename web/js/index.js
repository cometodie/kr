$("#button_events").click(function() {
    $('html, body').animate({
        scrollTop: $("#toEvent").offset().top
    }, 1000);
});
$("#button_news").click(function() {
    $('html, body').animate({
        scrollTop: $("#toNews").offset().top
    }, 1000);
}); 