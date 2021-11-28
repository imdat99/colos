jQuery(function ($) {
    $('.owl-carousel').owlCarousel({
        items: 4,
        lazyLoad: true,
        nav: true,
        navText: ['<div class="ladi-carousel-arrow ladi-carousel-arrow-left">a</div>', '<div class="ladi-carousel-arrow ladi-carousel-arrow-right">b</div>'],
        pagination: false,
        autoplay: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 4,
                nav: false
            }
        }

    });



});


