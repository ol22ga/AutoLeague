@extends('layout.app')
@section('title', 'Название товара')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Название товара</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li><a href="{{route('CatalogPage')}}">Каталог</a></li>
                                    <li><a href="#">Название категории</a></li>
                                    <li class="active" aria-current="page">{{$product->title}}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- ФОТО И ОПИСАНИЕ -->
    <div class="product-gallery">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery__wrapper">
                        <div class="product-gallery__slider--large">
                            @foreach($product->product_images as $item)
                            <div class="product-gallery__item--large zoom-image-hover">
                                <img src="{{$item->img}}" alt="">
                            </div>
                            @endforeach
                        </div> <!-- .product-gallery__slider--large -->
                        <div class="product-gallery__slider--small">
                            @foreach($product->product_images as $item)
                            <div class="zoom-active product-gallery__item--small">
                                <img class="img-fluid" src="{{$item->img}}" alt="">
                            </div>
                            @endforeach
                        </div> <!-- .product-image-thumb .product-gallery__slider--small .pos-relative -->
                    </div> <!-- .product-gallery__wrapper -->
                </div> <!-- .col-md-6 -->
                <div class="col-md-6">
                    <div class="product-description">
                        <div class="product-description__text">
                            <h4 class="product-description__text--title">{{$product->title}}</h4>
                            <div class="d-flex align-items-center">
                                <div class="product-description__review">
                                    <span class="product-description__star product-description__star--fill"><i class="fa fa-star"></i></span>
                                    <span class="product-description__star"><i class="fa fa-star"></i></span>
                                    <span class="product-description__star"><i class="fa fa-star"></i></span>
                                    <span class="product-description__star"><i class="fa fa-star"></i></span>
                                    <span class="product-description__star"><i class="fa fa-star"></i></span>
                                </div>
                                <a href="" class="product-description__text--link">(отзывы)</a>
                            </div>
                            <div class="product-description__text--price"><del>{{$product->old_price}} ₽</del>{{$product->new_price}} ₽</div>
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="row align-items-center mb-20">
                            <div class="col-lg-6">
                                <button data-bs-toggle="modal" data-bs-target="#modalAddcart" class="button">В корзину</button>
                            </div>
                        </div>
                        <div class="product-meta mb-20">
                            <ul>
                                <li><a href=""><i class="fa fa-heart-o"></i>Добавить в избранное</a></li>
                                <li><a href=""><i class="fa fa-repeat"></i>Сравнить</a></li>
                            </ul>
                        </div>
                    </div> <!-- .product-details-content-area -->
                </div> <!-- .col-md-6 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .product-gallery -->

    <!-- ОПИСАНИЕ/ХАРАКТЕРИСТИКИ/ОТЗЫВЫ -->
    <div class="product-details section-inner-bg section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details__wrapper">
                        <ul class="nav tab__list-btn tab__list-btn--detail d-flex justify-content-center">
                            <li><a href="#description" class="nav-link active">
                                    <h5>Описание</h5>
                                </a></li>
                            <li><a href="#specification" class="nav-link">
                                    <h5>Характеристики</h5>
                                </a></li>
                            <li><a href="#review" class="nav-link">
                                    <h5>Отзывы (3)</h5>
                                </a></li>
                        </ul> <!-- .nav .tab__list-btn .tab__list-btn--detail .d-flex .justify-content-center -->
                        <div class="product-details__content">
                            <div class="tab">
                                <div class="tab__content active show" id="description">
                                    <p>{{$product->description}}</p>
                                </div> <!-- .tab-pane -->
                                <div class="tab__content" id="specification">
                                    <table class="table">
                                        <tbody class="table__content">
                                        <tr>
                                            <td class="text-left">Производитель</td>
                                            <td class="text-left">{{$product->manufacturer->title}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Материал</td>
                                            <td class="text-left">{{$product->material}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Комплектация</td>
                                            <td class="text-left">{{$product->complete_set}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Вес</td>
                                            <td class="text-left">{{$product->weight}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- .tab-pane -->
                                <div class="tab__content" id="review">
                                    <div class="comment">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="comment__wrapper">
                                                        <h4 class="mb-30">Отзывы</h4>
                                                        <ul class="comment__list">
                                                            <li class="comment__item">
                                                                <div class="comment__inner">
                                                                    <div class="comment__img">
                                                                        <img src="{{asset('public/images/user/image-1.png')}}" alt="">
                                                                    </div>
                                                                    <div class="comment__content">
                                                                        <div class="comment__content--top">
                                                                            <h6 class="comment__name">Имя Фамилия</h6>
                                                                        </div>
                                                                        <div class="comment__text">
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                                        </div>
                                                                    </div> <!-- .comment__content -->
                                                                </div> <!-- .comment__inner -->
                                                            </li> <!-- .comment__item -->
                                                        </ul> <!-- .comment__list -->
                                                        <div class="form">
                                                            <h5 class="form__title mb-20">Оставить отзыв</h5>
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
                                                                            <label for="contact-message">Текст отзыва <span>*</span></label>
                                                                            <textarea id="contact-message" placeholder="Введите текст отзыва "></textarea>
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
                                </div> <!-- .tab-pane -->
                            </div> <!-- .tab -->
                        </div> <!-- .product-details__content -->
                    </div> <!-- .product-details__wrapper -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .product-details .section-inner-bg section-top-gap-100 -->
@endsection
