@extends('layout.app')
@section('title', 'Контакты')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Контакты</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li class="active" aria-current="page">Контакты</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- КАРТА -->
    <div class="map-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mapouter">
                        <div class="map-section__wrapper">
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afdd42e5286c25a38ece67c95003963aa1b335ae84a19f20db9191997c0a20806&amp;source=constructor" width="1178" height="500" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .container -->

    <!-- КОНТАКТЫЕ ДАННЫЕ/ФОРМА ОБРАТНОЙ СВЯЗИ -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-section__wrapper section-top-gap-100">
                        <div class="contact-section__connection">
                            <div class="contact-section__item">
                                <div class="contact-section__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-section__content">
                                    <a href="tel:+012345678102"> +7 (908) 744-58-02</a>
                                </div>
                            </div> <!-- .contact-section__item -->
                            <div class="contact-section__item">
                                <div class="contact-section__icon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="contact-section__content">
                                    <a href="mailto:autoplanetnn@yandex.ru">autoplanetnn@yandex.ru</a>
                                </div>
                            </div> <!-- .contact-section__item -->
                            <div class="contact-section__item">
                                <div class="contact-section__icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-section__content">
                                    <span>г. Нижний Новгород,</span>
                                    <span>ул. Восточный проезд, д.9</span>
                                </div>
                            </div> <!-- .contact-section__item -->
                        </div> <!-- .contact-details -->
                        <div class="contact-section__text  mt-3">
                            <h6>Оставьте заявку на обратный звонок, если у Вас остались вопросы.</h6>
                            <h6>В ближайшее время с Вами свяжется администратор.</h6>
                        </div>
                    </div> <!-- .contact-section__details .section-top-gap-100 -->
                </div> <!-- .col-lg-4 -->
                <div class="col-lg-8">
                    <form-application-component></form-application-component>
                </div> <!-- .col-lg-8 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .contact-section -->
@endsection
