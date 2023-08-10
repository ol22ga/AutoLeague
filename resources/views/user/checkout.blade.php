@extends('layout.app')
@section('title', 'Оформление заказа')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Оформление заказа</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li><a href="{{route('CatalogPage')}}">Каталог</a></li>
                                    <li><a href="{{route('CartPage')}}">Корзина</a></li>
                                    <li class="active" aria-current="page">Оформление заказа</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <div class="order">
        <div class="container">
            <place-an-order-component></place-an-order-component>
        </div> <!-- .container -->
    </div> <!-- .checkout_section -->
@endsection
