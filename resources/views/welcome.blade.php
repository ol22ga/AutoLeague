@extends('layout.app')
@section('title', 'Главная')
@section('content')
    <!-- БАННЕР -->
    <div class="banner">
        <div class="banner__wrapper banner__dots fix-slider-dots">
            <div class="banner__item">
                <div class="banner__bg">
                    <img class="banner__img" src="{{asset('public/images/slider/slider_1.jpg')}}" alt="">
                </div>
                <div class="banner__content">
                    <div class="container">
                        <div class="row justify-content-sm-center">
                            <div class="col-12">
                                <h5>Мы гарантируем</h5>
                                <h2>Высокое качество</h2>
                                <p class="d-none d-sm-inline">Наша компания предлагает широкий ассортимент автозапчастей высокого качества для различных марок и моделей автомобилей</p>
                                <div class="row mt-2 mt-sm-8">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <a href="#" class="button">Начать покупки</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .banner__content -->
            </div> <!-- .banner__item -->
            <div class="banner__item">
                <div class="banner__bg">
                    <img class="banner__img" src="{{asset('public/images/slider/slider_2.jpg')}}" alt="">
                </div>
                <div class="banner__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h5>Мы осуществляем</h5>
                                <h2>Доставку по всей стране</h2>
                                <p class="d-none d-sm-inline">Мы работаем только с надежными курьерскими службами, чтобы гарантировать быструю и безопасную доставку</p>
                                <div class="row mt-2 mt-sm-8">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <a href="#" class="button">Начать покупки</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .banner__content -->
            </div> <!-- .banner__item -->
            <div class="banner__item">
                <div class="banner__bg">
                    <img class="banner__img" src="{{asset('public/images/slider/slider_2.jpg')}}" alt="">
                </div>
                <div class="banner__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h5>Мы предлагаем</h5>
                                <h2>Выгодные цены</h2>
                                <p class="d-none d-sm-inline">Мы стремимся предоставлять нашим клиентам лучшее соотношение цены и качества, поэтому вы можете быть уверены, что приобретая запчасти у нас, вы получаете отличное качество по разумной цене</p>
                                <div class="row mt-2 mt-sm-8">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <a href="#" class="button">Начать покупки</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .banner__content -->
            </div> <!-- .banner__item -->
        </div> <!-- .banner__wrapper .hero-slider-dots .fix-slider-dots -->
    </div> <!-- .banner -->

    <!-- ПОПУЛЯРНЫЕ КАТЕГОРИИ -->
    <div class="catagory-section section-top-gap-100">
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content">
                        <h3 class="section-title">Популярные категории</h3>
                    </div>
                </div>
            </div>
        </div> <!-- .section-content-gap -->

        <div class="category-section__wrapper category">
            <div class="container">
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <a href="#" class="category__item mb-3 mb-sm-5">
                            <div class="category__img">
                                <img src="{{$category->img}}" alt="">
                            </div>
                            <div class="category__content">
                                <h5 class="category__title" lang="ru">{{$category->title}}</h5>
                                <span class="category__count">({{$category->products_count}} товаров)</span>
                            </div>
                        </a>
                    </div> <!-- .col-lg-3 .col-md-4 .col-sm-6 .col-12 -->
                    @endforeach
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .product-catagory-wrapper -->
    </div> <!-- .catagory-section .section-top-gap-100 -->

    <!-- НОВИНКИ -->
    <div class="product-tab-section section-top-gap-100">
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                        <h3 class="section-title">Новинки</h3>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .section-content-gap -->

        <div class="product-tab-section__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab tab--animate-zoom">
                            <div class="tab__content show active">
                                <div class="product-slider product-slider--4grids">
                                    @foreach($new_products as $product)
                                    <div class="product border-around">
                                        <div class="product__wrapper">
                                            <a href="{{route('ProductDetailsPage')}}" class="product__img-link">
                                                @if(isset($product->product_images[0]))
                                                    <img src="{{$product->product_images[0]->img}}" alt="" class="product__img img-fluid">
                                                @endif
                                            </a>
                                            <div class="product__list-icon">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-repeat"></i></a></li>
                                                    <li class="d-md-block d-none"><a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div> <!-- .product-action-icon-link -->
                                        </div> <!-- .product-img-warp -->
                                        <div class="product__content">
                                            <h6 class="product__link"><a href="{{route('ProductDetailsPage')}}">{{$product->title}}</a></h6>
                                            <span class="product__price"><del class="product__price--off">{{$product->old_price}} ₽</del> {{$product->new_price}} ₽</span>
                                        </div> <!-- .product__content -->
                                    </div> <!-- .product .border-around -->
                                    @endforeach
                                </div> <!-- .product-slider .product-slider--4grids -->
                            </div> <!-- .tab-pane -->
                        </div> <!-- .tab-content .tab-animate-zoom -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .product-tab-wrapper -->
    </div> <!-- .product-tab-section .section-top-gap-100 -->

    <!-- МАРКИ АВТОМОБИЛЕЙ -->
    <div class="logo-section section-top-gap-100">
        <div class="logo-section__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="logo-section__slider">
                            @foreach($brands as $brand)
                            <div class="logo-section__item">
                                <img src="{{$brand->img}}" alt="{{$brand->title}}" class="img-fluid company-logo-image">
                            </div>
                            @endforeach
                        </div> <!-- .logo-section__slider -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .logo-section__wrapper -->
    </div> <!-- .logo-section .section-top-gap-100 -->

    <!-- ХИТЫ ПРОДАЖ -->
    <div class="product-tab-section section-top-gap-100">
        <div class="section-content-gap">
            <div class="container">
                <div class="row">
                    <div class="section-content d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column">
                        <h3 class="section-title">Хиты продаж</h3>
{{--                        <ul class="nav tab__list-btn tab__list-btn--sort">--}}
{{--                            <li><a href="#" class="nav-link active">Категория 1</a></li>--}}
{{--                            <li><a href="#" class="nav-link">Категория 1</a></li>--}}
{{--                            <li><a href="#" class="nav-link">Категория 1</a></li>--}}
{{--                        </ul>--}}
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .section-content-gap -->

        {{-- ПРОПИСАТЬ ID И ССЫЛКИ ДЛЯ ПЕРЕКЛЮЧЕНИЯ КАТЕГОРИЙ! --}}

        <div class="product-tab-section__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab tab--animate-zoom">
                            <div class="tab__content show active">
                                <div class="product-slider product-slider--4grids">
                                    @foreach($hit_of_sales as $product)
                                        <div class="product border-around">
                                            <div class="product__wrapper">
                                                <a href="{{route('ProductDetailsPage')}}" class="product__img-link">
                                                    @if(isset($product->product_images[0]))
                                                        <img src="{{$product->product_images[0]->img}}" alt="" class="product__img img-fluid">
                                                    @endif
                                                </a>
                                                <div class="product__list-icon">
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-repeat"></i></a></li>
                                                        <li class="d-md-block d-none"><a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div> <!-- .product-action-icon-link -->
                                            </div> <!-- .product-img-warp -->
                                            <div class="product__content">
                                                <h6 class="product__link"><a href="{{route('ProductDetailsPage')}}">{{$product->title}}</a></h6>
                                                <span class="product__price"><del class="product__price--off">{{$product->old_price}} ₽</del> {{$product->new_price}} ₽</span>
                                            </div> <!-- .product__content -->
                                        </div> <!-- .product .border-around -->
                                    @endforeach
                                </div> <!-- .product-slider .product-slider--4grids -->
                            </div> <!-- .tab-pane -->
                        </div> <!-- .tab-content .tab-animate-zoom -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .product-tab-wrapper -->
    </div> <!-- .product-tab-section .section-top-gap-100 -->

    <!-- ПОСЛЕДНИЕ НОВОСТИ -->
{{--    <div class="blog-section section-top-gap-100">--}}
{{--        <div class="section-content-gap">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="section-content">--}}
{{--                        <h3 class="section-title">Последние новости</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div> <!-- .container -->--}}
{{--        </div> <!-- .section-content-gap -->--}}

{{--        <div class="blog-section__wrapper">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-4 col-md-6 col-12">--}}
{{--                        <div class="article">--}}
{{--                            <a href="blog-single-sidebar-left.html" class="article__img-link">--}}
{{--                                <img src="{{asset('public/images/blog_images/aments_blog_01.jpg')}}" alt="" class="article__img">--}}
{{--                            </a>--}}
{{--                            <div class="article__content">--}}
{{--                                <div class="article__info">--}}
{{--                                    <span class="article__text">Автор: </span>--}}
{{--                                    <span class="article__text">Admin</span> ---}}
{{--                                    <span class="article__text">01.01.2023</span>--}}
{{--                                </div>--}}
{{--                                <h5 class="article__link"><a href="{{route('ArticleDetailsPage')}}">Illum animi quo praesentium accusamus debitis</a></h5>--}}
{{--                            </div> <!-- .article__content -->--}}
{{--                        </div> <!-- .article -->--}}
{{--                    </div> <!-- .col-lg-4 .col-md-6 .col-12 -->--}}
{{--                </div> <!-- .row -->--}}
{{--            </div> <!-- .container -->--}}
{{--        </div> <!-- .blog-section__wrapper -->--}}
{{--    </div> <!-- .blog-section .section-top-gap-100 -->--}}
@endsection
