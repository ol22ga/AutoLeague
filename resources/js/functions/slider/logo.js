$('.logo-section__slider').slick({
    autoplay: true,
    infinite:true,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    easing: 'linear',
    speed: 1000,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4
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
