@extends('layout.app')
@section('title', 'Часто задаваемые воспросы')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Часто задаваемые воспросы</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li class="active" aria-current="page">FAQ</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->



    <!-- ЧАСТО ЗАДАВАЕМЫЕ ВОПРОСЫ -->
    <div class="faq">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="faq__text">
                        <h5>Ниже Вы можете найти ответы на часто задаваемые вопросы</h5>
                    </div>
                </div>
            </div> <!-- .row -->
            <div class="faq__wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="accordian">
                            @foreach($questions as $question)
                            <div class="accordian__item">
                                <input id="{{$question->id}}" name="accordian__radio" type="radio" checked="">
                                <label for="{{$question->id}}">{{$question->text}}</label>
                                <div class="accordian__content">
                                    <p>{{$question->answer}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div> <!-- .faq__accordian -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .faq__wrapper -->
        </div> <!-- .container -->
    </div> <!-- .faq -->

    @auth()
    <div class="container">
        <form-question-component></form-question-component>
    </div>
    @endauth
@endsection
