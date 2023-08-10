<div id="OffcanvasMobileMenu" class="offcanvas offcanvas__right">
    <div class="offcanvas__header text-right">
        <button class="offcanvas__close"><i class="fa fa-close"></i></button>
    </div>
    <div class="offcanvas__wrapper  mobile-menu">
        <div class="mobile-menu__top row d-flex justify-content-between align-items-center">
            <span class="mobile-menu__text">Добро пожаловать в наш магазин!</span>
            <ul class="mobile-menu__menu--user">
                <li><a class="mobile-menu__link" href="{{route('ComparePage')}}"><i class="icon-repeat"></i>Сравнить (0)</a></li>
                <li><a class="mobile-menu__link" href="{{route('ComparePage')}}"><i class="icon-repeat"></i>Личный кабинет</a></li>
            </ul>
        </div> <!-- .mobile-menu__top .row .d-flex .justify-content-between .align-items-center -->
        <div class="mobile-menu__center">
            <form action="#" method="post" class="form--search">
                <div class="form--search__item d-flex">
                    <input class="form--search__input border-around border-right-none" type="search" placeholder="Введите текст запроса" required>
                    <button class="form--search__btn" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div> <!-- .mobile-menu__center -->
        <div class="mobile-menu__bottom">
            <div class="offcanvas__menu">
                <ul>
                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                    <li><a href="{{route('CatalogPage')}}">Каталог</a></li>
                    <li><a href="{{route('FaqPage')}}">FAQ</a></li>
                    <li><a href="{{route('BlogPage')}}">Блог</a></li>
                    <li><a href="{{route('AboutUsPage')}}">О нас</a></li>
                    <li><a href="{{route('ContactPage')}}">Контакты</a></li>
                </ul>
            </div> <!-- .offcanvas__menu -->
            <a class="mobile-menu__connection icon-text-right" href=""><i class="fa fa-envelope-o"> autoo-league@gmail.com</i></a>
            <a class="mobile-menu__connection icon-text-right" href=""><i class="fa fa-mobile-phone"> +7 (908) 744-58-02</i></a>
        </div> <!-- .mobile-menu__bottom -->
    </div> <!-- .offcanvas__wrapper  .mobile-menu -->
</div> <!-- .offcanvas .offcanvas__left -->
