@extends('layout.app')
@section('title', 'Авторизация')
@section('content')
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Авторизация</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li class="active" aria-current="page">Авторизация</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="form">
                    <login-component></login-component>
                    <div class="d-flex flex-column">
                        <a href="{{route('RegistrationPage')}}">Регистрация</a>
                        <a href="{{route('LoginPasswordPage')}}">Войти с паролем</a>
                    </div>
                </div> <!-- .form .section-top-gap-100 -->
            </div>
        </div>
    </div>
@endsection
