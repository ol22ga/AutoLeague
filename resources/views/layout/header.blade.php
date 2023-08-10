@include('layout.offcanvas.mobile-menu')
@include('layout.offcanvas.wishlist')



<header class="header d-lg-block d-none">
    <div class="header__top">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-6">
                    <div class="header__top--left">
                        <span>Добро пожаловать в наш магазин!</span>
                    </div>
                </div> <!-- .col-6 -->
                <div class="col-6">
                    <div class="header__top--right">
                        <ul class="header__menu--user">
                            @auth()
                                @if(Auth::user() && Auth::user()->role === 'admin')
                                <li class="header__dropdown--user">
                                    <a href="">Админ-панель</a>
                                    <ul class="header__submenu--user">
                                        <li><a href="{{route('CategoriesPage')}}">Категории</a></li>
                                        <li><a href="{{route('BrandsPage')}}">Марки</a></li>
                                        <li><a href="{{route('ManufacturersPage')}}">Производители</a></li>
                                        <li><a href="{{route('ProductsPage')}}">Товары</a></li>
                                        <li><a href="{{route('OrdersPage')}}">Заказы</a></li>
                                        <li><a href="{{route('ApplicationsPage')}}">Заявки</a></li>
                                        <li><a href="{{route('QuestionsPage')}}">Вопросы</a></li>
                                    </ul>
                                </li>
                                @endif
                            @endauth
                            @auth()
                            <li class="header__dropdown--user">
                                <a href="">Аккаунт</a>
                                    <ul class="header__submenu--user">
                                    <li><a href="{{route('AccountPage')}}">Профиль</a></li>
                                    <li><a href="{{route('CartPage')}}">Корзина</a></li>
                                    <li><a href="{{route('WishlistPage')}}">Избранное</a></li>
                                    <li><a href="{{route('Logout')}}">Выход</a></li>
                                </ul>
                            </li>
                            @endauth
                            @guest()
                            <li><a href="{{route('LoginPasswordPage')}}"><i class="icon-repeat"></i>Вход</a></li>
                            @endguest
{{--                            @auth()--}}
{{--                            <li><a href="{{route('ComparePage')}}"><i class="icon-repeat"></i> Сравнить (0)</a></li>--}}
{{--                            @endauth--}}
                        </ul>
                    </div>
                </div> <!-- .col-6 -->
            </div> <!-- .row .d-flex .justify-content-between .align-items-center -->
        </div> <!-- .container -->
    </div> <!-- .header__top -->

    <div class="header__center">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-3">
                    <div class="header__logo">
                        <a href="{{route('MainPage')}}"><img src="{{asset('public/images/logo/dark.png')}}" alt="АвтоЛига"></a>
                    </div>
                </div> <!-- .col-3 -->
                <div class="col-6">
                    <div class="search">
                        <search-component></search-component>
                    </div>
                </div> <!-- .col-6 -->
                <div class="col-3 text-right">
                    <ul class="header__list-icon">
                        <li>
                            <a href="#OffcanvasWishlist" class="offcanvas__toggle">
                                <i class="fa fa-heart-o"></i>
                                <span class="header__count">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="#OffcanvasCart" id="OffcanvasCartOpen" class="offcanvas__toggle">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="header__count">3</span>
                            </a>
                        </li>
                    </ul>
                </div> <!-- .col-3 .text-right -->
            </div> <!-- .row .d-flex .justify-content-between .align-items-center -->
        </div> <!-- .container -->
    </div> <!-- .header__center -->

    <div class="header__bottom sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li>
                                    <a href="{{route('MainPage')}}">Главная</a>
                                </li>
                                <li class="main-menu__dropdown main-menu__megaitem">
                                    <a href="{{route('CatalogPage')}}">Каталог <i class="fa fa-angle-down"></i></a>
                                    <div class="mega-menu">
                                        <ul class="mega-menu__inner">
                                            <li class="mega-menu__item">
                                                <a href="#" class="mega-menu__title">Shop Layouts</a>
                                                <ul class="mega-menu__sub">
                                                    <li><a href="">Grid Left Sidebar</a></li>
                                                </ul>
                                            </li> <!-- .mega-menu__item -->
                                        </ul> <!-- .mega-menu__inner -->
                                        <div class="mega-menu__banner">
                                            <a href="" class="mega-menu__link">
                                                <img class="menu-banner-img" src="{{asset('public/images/banner/menu-banner.jpg')}}" alt="">
                                            </a>
                                        </div> <!-- .mega-menu__banner -->
                                    </div> <!-- .mega-menu -->
                                </li> <!-- .main-menu__dropdown .main-menu__megaitem -->
                                <li>
                                    <a href="{{route('FaqPage')}}">FAQ</a>
                                </li>
                                <li>
                                    <a href="{{route('BlogPage')}}">Блог</a>
                                </li>
                                <li>
                                    <a href="{{route('AboutUsPage')}}">О нас</a>
                                </li>
                                <li>
                                    <a href="{{route('ContactPage')}}">Контакты</a>
                                </li>
                            </ul> <!-- ul -->
                        </nav> <!-- nav -->
                    </div> <!-- .main-menu -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .header__bottom -->
</header> <!-- .header -->

<div class="header--mobile d-block d-lg-none">
    <div class="header--mobile__wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="header--mobile__left">
                        <a href="{{route('MainPage')}}" class="header--mobile__logo">
                            <img src="{{asset('public/images/logo/dark.png')}}" alt="АвтоЛига" class="header--mobile__img">
                        </a>
                    </div>
                    <ul class="header__list-icon">
                        <li class="header__icon--mobile">
                            <a href="#OffcanvasCart" class="offcanvas__toggle">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="header__count">3</span>
                            </a>
                        </li>
                        <li class="header__icon--mobile">
                            <a href="#OffcanvasMobileMenu" class="offcanvas__toggle">
                                <i class="fa fa-list"></i>
                            </a>
                        </li>
                    </ul>
                </div> <!-- .col-12 .d-flex .justify-content-between .align-items-center -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .header-mobile__wrapper -->
</div> <!-- .header-mobile .d-block .d-lg-none -->

<div class="offcanvas__overlay"></div> <!-- .offcanvas__overlay -->
