(function () {
    var $window = $(window),
        $body = $('body');
    var $offCanvasToggle = $('.offcanvas__toggle'),
        $offCanvas = $('.offcanvas'),
        $offCanvasOverlay = $('.offcanvas__overlay'),
        $mobileMenuToggle = $('.mobile-menu-toggle');
    $offCanvasToggle.on('click', function (e) {
        e.preventDefault();
        var $this = $(this),
            $target = $this.attr('href');
        $body.addClass('offcanvas--open');
        $($target).addClass('offcanvas--open');
        $offCanvasOverlay.fadeIn();
        if ($this.parent().hasClass('mobile-menu-toggle')) {
            $this.addClass('close');
        }
    });
    $('.offcanvas__close, .offcanvas__overlay').on('click', function (e) {
        e.preventDefault();
        $body.removeClass('offcanvas--open');
        $offCanvas.removeClass('offcanvas--open');
        $offCanvasOverlay.fadeOut();
        $mobileMenuToggle.find('a').removeClass('close');
    });
})();
