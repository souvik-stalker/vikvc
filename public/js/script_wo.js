$(document).ready(function() {
    resizeContrainer();
});

$(window).resize(function() {
    resizeContrainer();
});

function resizeContrainer() {
    var winheight = $(window).height();

    var headerHeight = $('.header').height();
    var mainContentHeight = $('.main_content_wrapper').height();
    var footerHeight = $('.footer').height();
    var totalContentHeight = parseInt(headerHeight) + parseInt(mainContentHeight) + parseInt(footerHeight);

    if (totalContentHeight < winheight) {
        mainContentHeight = parseInt(winheight) - (parseInt(headerHeight) + parseInt(footerHeight) + 30);
        $('.main_content_wrapper').height(mainContentHeight);
    }
}