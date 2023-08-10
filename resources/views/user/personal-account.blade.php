@extends('layout.app')
@section('title', 'Личный кабинет')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Личный кабинет</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li class="active" aria-current="page">Личный кабинет</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- ПАНЕЛЬ УПРАВЛЕНИЯ -->
    <div class="account_dashboard">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="dashboard">
                        <ul role="tablist" class="nav flex-column dashboard__list">
{{--                            <li class="account__img">--}}
{{--                                <img src="{{asset('public/images/blog_recent_post/blog1.jpg')}}" alt="">--}}
{{--                            </li>--}}
                            <li> <a href="#orders" class="nav-link">Заказы</a></li>
                            <li><a href="#account-details" class="nav-link active">Профиль</a></li>
                            <li><a href="{{route('Logout')}}" class="dashboard__link">Выход</a></li>
                        </ul>
                    </div> <!-- .dashboard_tab_button -->
                </div> <!-- .col-sm-12 .col-md-3 .col-lg-3 -->
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="tab-content dashboard__content">
                        <div class="tab-pane fade tab__content" id="orders">
                            <h4>Мои заказы</h4>
                            <orders-component></orders-component>
                        </div> <!-- .tab-pane .fade -->

                        <div class="tab-pane fade tab__content show active" id="account-details">
                            <h4>Мой профиль</h4>
                            <personal-data-component></personal-data-component>
                        </div> <!-- .tab-pane .fade -->
                    </div> <!-- .tab-content .dashboard_content -->
                </div> <!-- .col-sm-12 .col-md-9 .col-lg-9 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .account_dashboard -->
@endsection
