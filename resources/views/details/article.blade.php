@extends('layout.app')
@section('title', 'Название статьи')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Название статьи</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li><a href="{{route('BlogPage')}}">Блог</a></li>
                                    <li class="active" aria-current="page">Название статьи</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- СТАТЬЯ -->
    <div class="article-detail">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row-reverse">
                <div class="col-lg-12">
                    <div class="article-detail__wrapper">
                        <div class="article-detail__img">
                            <img class="img-fluid" src="{{asset('public/images/blog_images/blog-big1.jpg')}}" alt="">
                        </div>
                        <div class="article-detail__inner">
                            <div class="article-detail__info">
                                <span>Автор:</span>
                                <span class="article__text">Admin</span> -
                                <span class="article__text">01.01.2023</span>
                            </div>
                            <div class="article__view">
                                <span><i class="fa fa-eye"></i></span>
                                <span class="article__text article-detail__count">10</span>
                            </div>
                        </div>
                        <h4 class="article-detail__title">Название статьи</h4>
                        <div class="article-detail__content">
                            <blockquote class="article-detail__blockquote">
                                Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur. In venenatis elit ac ultrices convallis. Duis est nisi, tincidunt ac urna sed, cursus blandit lectus. In ullamcorper sit amet ligula ut eleifend. Proin dictum tempor ligula, ac feugiat metus. Sed finibus tortor eu scelerisque scelerisque.
                            </blockquote>
                            <p>Aenean et tempor eros, vitae sollicitudin velit. Etiam varius enim nec quam tempor, sed efficitur ex ultrices. Phasellus pretium est vel dui vestibulum condimentum. Aenean nec suscipit nibh. Phasellus nec lacus id arcu facilisis elementum. Curabitur lobortis, elit ut elementum congue, erat ex bibendum odio, nec iaculis lacus sem non lorem. Duis suscipit metus ante, sed convallis quam posuere quis. Ut tincidunt eleifend odio, ac fringilla mi vehicula nec. Nunc vitae lacus eget lectus imperdiet tempus sed in dui. Nam molestie magna at risus consectetur, placerat suscipit justo dignissim. Sed vitae fringilla enim, nec ullamcorper arcu.</p>
                        </div>
                    </div> <!-- .article-detail__wrapper -->
                </div> <!-- .col-lg-12 -->
            </div> <!-- .row .flex-column-reverse .flex-lg-row-reverse -->
        </div> <!-- .container -->
    </div> <!-- .article-detail -->

    <div class="comment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="comment__wrapper">
                        <h4 class="mb-30">Комментарии</h4>
                        <ul class="comment__list">
                            <li class="comment__item">
                                <div class="comment__inner">
                                    <div class="comment__img">
                                        <img src="{{asset('public/images/user/image-1.png')}}" alt="">
                                    </div>
                                    <div class="comment__content">
                                        <div class="comment__content--top">
                                            <h6 class="comment__name">Имя Фамилия</h6>
                                            <div class="comment__content--right">
                                                <a href="#"><i class="fa fa-reply"></i>Ответить</a>
                                            </div>
                                        </div>
                                        <div class="comment__text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                        </div>
                                    </div> <!-- .comment__content -->
                                </div> <!-- .comment__inner -->
                            </li> <!-- .comment__item -->
                        </ul> <!-- .comment__list -->
                        <div class="form">
                            <h5 class="form__title mb-20">Оставить комментарий</h5>
                            <p>Ваш адрес электронной почты опубликован не будет. Обязательные поля отмечены *</p>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form__item mb-20">
                                            <label for="contact-name">Имя <span>*</span></label>
                                            <input type="text" id="contact-name" placeholder="Введите имя">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form__item mb-20">
                                            <label for="contact-email">Email <span>*</span></label>
                                            <input type="text" id="contact-email" placeholder="Введите email ">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form__item mb-20">
                                            <label for="contact-message">Текст комментария <span>*</span></label>
                                            <textarea id="contact-message" placeholder="Введите текст комментария "></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button class="button button--dark" type="submit">Опубликовать</button>
                                    </div>
                                </div> <!-- .row -->
                            </form> <!-- form -->
                        </div> <!-- .form .section-top-gap-100 -->
                    </div> <!-- .comment__wrapper -->
                </div>
            </div>
        </div>
    </div>
@endsection
