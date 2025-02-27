console.log('menu..');

jQuery(document).ready(function($) {

    var header = $('header');
    var burger = $('.burger');
    var nav = $('.main-nav');

    burger.on('click', function() {

        if(burger.hasClass('is-open')) {
            burger.removeClass('is-open');
            nav.removeClass('is-open');
            header.removeClass('menu-open');
        }else{
            burger.addClass('is-open');
            nav.addClass('is-open');
            header.addClass('menu-open');
        }

    });

});
