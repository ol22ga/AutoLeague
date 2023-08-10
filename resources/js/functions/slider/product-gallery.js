$('.product-gallery__slider--large').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.product-gallery__slider--small'
});

$('.product-gallery__slider--small').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    focusOnSelect: true,
    arrows: true,
    asNavFor: '.product-gallery__slider--large',
    prevArrow: '<button type="button" class="product-gallery__nav product-gallery__nav--left prevArrow"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button type="button"  class="product-gallery__nav product-gallery__nav--right nextArrow"><i class="fa fa-angle-right"></i></button>',
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2
            }
        }
    ]
});

$('.zoom-image-hover').zoom();

$('.modal').on('shown.bs.modal', function (e) {
    $('.product-gallery__slider--large, .product-gallery__slider--small').slick('setPosition');
    $('.product-gallery__wrapper').addClass('open');
});
