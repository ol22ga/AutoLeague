(function ($) {
    "use strict";
    //ПЕРЕМЕННЫЕ
    var $window = $(window),
        $body = $('body');
    //ШАПКА ПРИ ПРОКРУТКЕ СТРАНИЦЫ
    import("./functions/header-scroll");
    //БОКОВЫЕ МЕНЮ (МОБИЛЬНОЕ/КОРЗИНА/ИЗБРАННОЕ)
    import('./functions/offcanvas.js');
    //СЛАЙДЕР (БАННЕР НА ГЛАВНОЙ СТРАНИЦЕ)
    import("./functions/slider/banner");
    //СЛАЙДЕР (ПРОКРУТКА ТОВАРОВ)
    import("./functions/slider/products");
    //СЛАЙДЕР (ЛОГОТИПЫ)
    import("./functions/slider/logo");
    //ГОРИЗОНТАЛЬНЫЙ СЛАЙДЕР (ГАЛЕРЕЯ ИЗОБРАЖЕНИЙ ТОВАРА)
    import("./functions/slider/product-gallery");
    //ВЫПАДАЮЩИЙ СПИСОК
    $('select').niceSelect();
    //ПРОКРУТКА СТРАНИЦЫ НАВЕРХ
    import("./functions/scroll");
    //ПЕРЕКЛЮЧАТЕЛИ
    import("./functions/switch");
    //ПОЛЗУНОК ДЛЯ ФИЛЬТРАЦИИ ЦЕНЫ
    import("./functions/price-range");
})(jQuery);
