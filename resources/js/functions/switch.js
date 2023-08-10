(function () {
    var $tabToggle = $('.nav-link'),
        $tabContent = $('.tab__content');

    $tabToggle.on('click', function (e) {
        e.preventDefault();

        var $this = $(this),
            $target = $this.attr('href');

        $tabToggle.removeClass('active');
        $tabContent.removeClass('active show');

        $this.addClass('active');
        $($target).addClass('active show');

        if ($(window).width() < 600) {
            $('.sort-tablist-display').hide();
            $('#products-grid').addClass('active show');
            $('#products-list').removeClass('active show');
            $('#products-grid-btn').addClass('active');
            $('#products-list-btn').removeClass('active');
        } else {
            $('.sort-tablist-display').show();
        }
        $( window ).resize(function() {
            if ($(window).width() < 600) {
                $('.sort-tablist-display').hide();
                $('#products-grid').addClass('active show');
                $('#products-list').removeClass('active show');
                $('#products-grid-btn').addClass('active');
                $('#products-list-btn').removeClass('active');
            } else {
                $('.sort-tablist-display').show();
            }
        });
    });
})();
