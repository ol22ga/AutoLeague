@extends('layout.app')
@section('title', 'Сравнение товаров')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Сравнение товаров</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li><a href="{{route('CatalogPage')}}">Каталог</a></li>
                                    <li class="active" aria-current="page">Сравнение товаров</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- СРАВНЕНИЕ ТОВАРОВ -->
    <div class="compare-section">
        <div class="compare-table-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive compare-table"> <!-- .table_page .table-responsive .compare-table -->
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="first-column">Товар</td>
                                        <td class="product-image-title">
                                            <a href="#" class="image"><img src="{{asset('public/images/products_images/aments_products_image_1.jpg')}}" alt="Compare Product"></a>
                                            <a href="#" class="title">Название товара</a>
                                        </td>
                                        <td class="product-image-title">
                                            <a href="#" class="image"><img src="{{asset('public/images/products_images/aments_products_image_1.jpg')}}" alt="Compare Product"></a>
                                            <a href="#" class="title">Название товара</a>
                                        </td>
                                        <td class="product-image-title">
                                            <a href="#" class="image"><img src="{{asset('public/images/products_images/aments_products_image_1.jpg')}}" alt="Compare Product"></a>
                                            <a href="#" class="title">Название товара</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Описание</td>
                                        <td class="pro-desc">
                                            <p>Однозначно, ключевые особенности структуры проекта, превозмогая сложившуюся непростую экономическую ситуацию, обнародованы. Ясность нашей позиции очевидна: внедрение современных методик однозначно определяет каждого участника как способного принимать собственные решения касаемо своевременного выполнения сверхзадачи.</p>
                                        </td>
                                        <td class="pro-desc">
                                            <p>Однозначно, ключевые особенности структуры проекта, превозмогая сложившуюся непростую экономическую ситуацию, обнародованы. Ясность нашей позиции очевидна: внедрение современных методик однозначно определяет каждого участника как способного принимать собственные решения касаемо своевременного выполнения сверхзадачи.</p>
                                        </td>
                                        <td class="pro-desc">
                                            <p>Однозначно, ключевые особенности структуры проекта, превозмогая сложившуюся непростую экономическую ситуацию, обнародованы. Ясность нашей позиции очевидна: внедрение современных методик однозначно определяет каждого участника как способного принимать собственные решения касаемо своевременного выполнения сверхзадачи.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Цена</td>
                                        <td class="pro-price">500 ₽</td>
                                        <td class="pro-price">500 ₽</td>
                                        <td class="pro-price">500 ₽</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Производитель</td>
                                        <td class="pro-stock">Производитель</td>
                                        <td class="pro-stock">Производитель</td>
                                        <td class="pro-stock">Производитель</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Материал</td>
                                        <td class="pro-stock">Материал</td>
                                        <td class="pro-stock">Материал</td>
                                        <td class="pro-stock">Материал</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Вес</td>
                                        <td class="pro-stock">Вес</td>
                                        <td class="pro-stock">Вес</td>
                                        <td class="pro-stock">Вес</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">В корзину</td>
                                        <td class="pro-addtocart"><a href="#" class="add-to-cart" data-toggle="modal" data-target="#modalAddcart"><span>В корзину</span></a></td>
                                        <td class="pro-addtocart"><a href="#" class="add-to-cart" data-toggle="modal" data-target="#modalAddcart"><span>В корзину</span></a></td>
                                        <td class="pro-addtocart"><a href="#" class="add-to-cart" data-toggle="modal" data-target="#modalAddcart"><span>В корзину</span></a></td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Удалить</td>
                                        <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                        <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                        <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Рейтинг</td>
                                        <td class="pro-ratting">
                                            <div class="product-review">
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-empty"><i class="fa fa-star"></i></span>
                                            </div>
                                        </td>
                                        <td class="pro-ratting">
                                            <div class="product-review">
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-empty"><i class="fa fa-star"></i></span>
                                            </div>
                                        </td>
                                        <td class="pro-ratting">
                                            <div class="product-review">
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-empty"><i class="fa fa-star"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- .table_desc -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .compare-table-wrapper -->
    </div> <!-- .compare-section -->
@endsection
