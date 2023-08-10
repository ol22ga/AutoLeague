$('.product-slider--4grids').slick({
    arrows: true,
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    rows: 1,
    easing: 'ease-out',
    speed: 1000,
    prevArrow: '<button type="button" class="product-slider__arrow product-slider__arrow--left prevArrow"><i class="fa fa-angle-left"></button>',
    nextArrow: '<button type="button"  class="product-slider__arrow product-slider__arrow--right nextArrow"><i class="fa fa-angle-right"></button>',
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
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 575,
            settings: {
                slidesToShow: 1,
            }
        },
    ]
});
