@extends('layout.app')
@section('title', 'О нас')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">О нас</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li class="active" aria-current="page">О нас</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- СЛОГАН И БАННЕР -->
    <div class="about-us-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about-us-banner__img">
                        <img class="img-fluid" src="{{asset('public/images/about/about.jpg')}}" alt="">
                    </div>
                    <div class="about-us-banner__content text-center">
                        <h4>Добро пожаловать в АвтоЛигу</h4>
                        <p>Надежность на дороге начинается с нами - выбирайте качественные автозапчасти от нашей компании!</p>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .about-us-banner -->


    <!-- ПРЕИМУЩЕСТВА -->
    <div class="advantages section-inner-bg section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="advantages__title text-center">
                        <h4>Почему выбирают нас?</h4>
                    </div>
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
            <div class="advantages__wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="advantages__item">
                            <div class="advantages__icon">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div class="advantages__content">
                                <h6>Доставка по всей России</h6>
                                <p>Мы работаем только с надежными курьерскими службами</p>
                            </div>
                        </div> <!-- .advantages__item -->
                    </div> <!-- .col-lg-3 .col-md-6 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="advantages__item">
                            <div class="advantages__icon">
                                <i class="fa fa-rub"></i>
                            </div>
                            <div class="advantages__content">
                                <h6>Выгодные цены</h6>
                                <p>Мы стремимся предоставлять Вам лучшее соотношение цены и качества</p>
                            </div>
                        </div> <!-- .advantages__item -->
                    </div> <!-- .col-lg-3 .col-md-6 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="advantages__item">
                            <div class="advantages__icon">
                                <i class="fa fa-thumbs-o-up"></i>
                            </div>
                            <div class="advantages__content">
                                <h6>Высокое качество продукции</h6>
                                <p>Мы предлагаем автозапчасти высокого качества для различных марок и моделей автомобилей</p>
                            </div>
                        </div> <!-- .advantages__item -->
                    </div> <!-- .col-lg-3 .col-md-6 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="advantages__item">
                            <div class="advantages__icon">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <div class="advantages__content">
                                <h6>Гарантия на все детали</h6>
                                <p>Мы предоставляем гарантию до полугода на все детали</p>
                            </div>
                        </div> <!-- .advantages__item -->
                    </div> <!-- .col-lg-3 .col-md-6 -->
                </div> <!-- .row -->
            </div> <!-- .service-promo-wrapper -->
        </div> <!-- .container -->
    </div> <!-- .service-promo .section-inner-bg .section-top-gap-100 -->


    <!-- ОПЛАТА/ДОСТАВКА/ГАРАНТИЯ -->
    <div class="about-us-info section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="about-us-info__item">
                        <img class="img-fluid" src="{{asset('public/images/about/payment.jpg')}}" alt="">
                        <h6>Оплата</h6>
                        <p>
                            Мы предлагаем оплату при получении заказа. Это значит, что вы можете оплатить свои запасные части в момент доставки.
                            Мы принимаем различные формы оплаты, чтобы обеспечить вашу удобство.
                            Эта система позволяет вам осмотреть товар и убедиться в его соответствии перед совершением оплаты.
                            Мы стремимся обеспечить простоту и надежность процесса оплаты, чтобы вы могли получить необходимые запчасти без лишних хлопот.
                        </p>
                    </div>
                </div> <!-- .col-lg-4 .col-md-6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="about-us-info__item">
                        <img class="img-fluid" src="{{asset('public/images/about/delivery.jpg')}}" alt="">
                        <h6>Доставка</h6>
                        <p>
                            Мы осуществляем доставку нашей продукции по всей стране.
                            Независимо от вашего местоположения, вы можете заказать нужные вам запасные части у нас, и мы обеспечим их быструю и надежную доставку.
                            Мы сотрудничаем с надежными логистическими партнерами, чтобы гарантировать, что ваши заказы доставляются вовремя и в целости.
                            Вам не придется беспокоиться о том, как получить необходимые запчасти - мы позаботимся о доставке прямо к вам.
                        </p>
                    </div>
                </div> <!-- .col-lg-4 .col-md-6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="about-us-info__item">
                        <img class="img-fluid" src="{{asset('public/images/about/warranty.jpg')}}" alt="">
                        <h6>Гарантия</h6>
                        <p>Мы гарантируем качество всех наших запасных частей и предлагаем гарантийное обслуживание.
                            В случае обнаружения дефектов или неисправностей в приобретенных у нас запчастях, мы обязуемся заменить их или вернуть вам деньги в соответствии с нашей политикой гарантии.
                            Ваша уверенность и удовлетворение являются нашим приоритетом, и мы готовы взять на себя ответственность за любые несоответствия качеству продукции.
                        </p>
                    </div>
                </div> <!-- .col-lg-4 .col-md-6 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .about-us-info .section-top-gap-100 -->


    <!-- ИСТОРИЯ -->
    <div class="history section-top-gap-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="history__img">
                        <img class="img-fluid" src="{{asset('public/images/about/history.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="history__content text-center">
                        <h4>О нас</h4>
                        <p>Мы предлагаем широкий ассортимент запасных частей для отечественных автомобилей.
                            У нас вы найдете высококачественные двигатели, тормозные системы, электрические компоненты и многое другое.
                            Наша команда готова предоставить профессиональные консультации и быструю доставку, чтобы ваш автомобиль снова был в отличном состоянии.
                        </p>
                    </div>
                </div>
            </div> <!-- .row .align-items-center -->
        </div> <!-- .container -->
    </div> <!-- .service-display-section .section-top-gap-100 -->
@endsection
