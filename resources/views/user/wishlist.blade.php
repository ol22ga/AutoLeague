@extends('layout.app')
@section('title', 'Избранное')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Избранное</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li><a href="{{route('CatalogPage')}}">Каталог</a></li>
                                    <li class="active" aria-current="page">Избранное</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- ИЗБРАННЫЕ ТОВАРЫ -->
    <div class="wishlist-section">
        <div class="wishlish-table-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content tab-animate-zoom">
                            <div class="tab-pane active show sort-layout-single" id="products-grid">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                        <div class="product border-around">
                                            <div class="product__wrapper">
                                                <a href="{{route('ProductDetailsPage')}}" class="product__img-link">
                                                    <img src="{{asset('public/images/products_images/aments_products_image_1.jpg')}}" alt="" class="product__img img-fluid">
                                                </a>
                                                <div class="product__list-icon">
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-repeat"></i></a></li>
                                                        <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div> <!-- .product-action-icon-link -->
                                            </div> <!-- .product-img-warp -->
                                            <div class="product__content">
                                                <h6 class="product__link"><a href="{{route('ProductDetailsPage')}}">Название товара</a></h6>
                                                <span class="product__price"><del class="product__price--off">700 ₽</del> 500 ₽</span>
                                            </div> <!-- .product__content -->
                                        </div> <!-- .product .border-around -->
                                    </div> <!-- .col-xl-3 .col-lg-4 .col-sm-6 .col-12 -->
                                </div> <!-- .row -->
                            </div> <!-- .tab-pane .active show .sort-layout-single -->
                        </div> <!-- .tab-content tab-animate-zoom -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container -->
            <div class="page-pagination text-center">
                <ul>
                    <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                    <li><a class="active" href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                </ul>
            </div> <!-- .page-pagination .text-center -->
        </div> <!-- .wishlish-table-wrapper -->
    </div> <!-- .wishlist-section -->
@endsection
