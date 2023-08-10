<footer class="footer section-top-gap-100">
    <div class="footer__top section-inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-5">
                    <div class="footer__widget footer__widget--contact">
                        <div class="footer__logo">
                            <a href="{{route('MainPage')}}"><img src="{{asset('public/images/logo/dark.png')}}" alt="" class="img-fluid"></a>
                        </div>
                        <div class="footer__contact">
                            <p>Надежность на дороге начинается с нами - выбирайте качественные автозапчасти от нашей компании!</p>
                            <div class="customer-support">
                                <a class="customer-support__connection icon-text-right" href="mailto:autoplanetnn@yandex.ru"><i class="fa fa-envelope-o"> autoplanetnn@yandex.ru</i></a>
                                <a class="customer-support__connection icon-text-right" href="tel:+012345678102"><i class="fa fa-phone"> +7 (908) 744-58-02</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-7">
                    <div class="footer__widget footer__widget--subscribe">
                        <h3 class="footer__title">Подпишитесь на рассылку, чтобы получать новости первыми</h3>
                        <form action="#" method="post" class="form--search">
                            <div class="footer-subscribe-box form--search__item d-flex">
                                <input class="form--search__input border-around border-right-none form--search__input--subscribe" type="email" placeholder="Введите свой email" required>
                                <button class="form--search__btn" type="submit">Подписаться</button>
                            </div>
                        </form>
                        <p class="footer__text">Мы никогда не передадим ваш адрес электронной почты <br> третьим лицам.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="footer__widget footer__widget--menu">
                        <h3 class="footer__title">Навигация</h3>
                        <div class="footer__menu">
                            <ul class="footer__nav">
                                <li><a href="{{route('MainPage')}}">Главная</a></li>
                                <li><a href="{{route('AboutUsPage')}}">О нас</a></li>
                                <li><a href="{{route('FaqPage')}}">FAQ</a></li>
                                <li><a href="{{route('ContactPage')}}">Контакты</a></li>
                            </ul>
                            <ul class="footer__nav">
                                <li><a href="{{route('CatalogPage')}}">Каталог</a></li>
                                <li><a href="{{route('BlogPage')}}">Блог</a></li>
                                <li><a href="{{route('PrivacyPage')}}">Политика <br> конфиденциальности</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .container -->
    </div> <!-- .footer-top -->
    <div class="footer__bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="footer__copyright">
                        <p class="footer__text  text-center">© 2018-2023 <a class="footer__link" href="">ООО "АВТОЛИГА"</a></p>
                    </div>
                </div>
{{--                <div class="col-lg-6 col-md-6">--}}
{{--                    <div class="footer__payment">--}}
{{--                        <a href=""><img class="img-fluid" src="{{asset('public/images/icon/payment-icon.png')}}" alt=""></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div> <!-- .footer__bottom -->
</footer> <!-- .footer-section -->
