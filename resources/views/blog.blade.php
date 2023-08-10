@extends('layout.app')
@section('title', 'Блог')
@section('content')
    <!-- ХЛЕБНЫЕ КРОШКИ -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                        <h3 class="breadcrumb-title">Блог</h3>
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="{{route('MainPage')}}">Главная</a></li>
                                    <li class="active" aria-current="page">Блог</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .breadcrumb-wrapper -->
    </div> <!-- .breadcrumb-section -->

    <!-- СТАТЬИ -->
    <div class="blog">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <div class="blog__wrapper">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-6">
                                <div class="article">
                                    <a href="blog-single-sidebar-left.html" class="article__img-link">
                                        <img src="{{asset('public/images/blog_images/aments_blog_01.jpg')}}" alt="" class="article__img">
                                    </a>
                                    <div class="article__content">
                                        <div class="article__info">
                                            <span class="article__text">Автор: </span>
                                            <span class="article__text">Admin</span> -
                                            <span class="article__text">01.01.2023</span>
                                        </div>
                                        <h5 class="article__link"><a href="{{route('ArticleDetailsPage')}}">Illum animi quo praesentium accusamus debitis</a></h5>
                                    </div> <!-- .article__content -->
                                </div> <!-- .article -->
                            </div> <!-- .col-lg-4 .col-md-6 .col-12 -->
                        </div> <!-- .row -->
                    </div> <!-- .blog__wrapper -->
                    <div class="page-pagination text-center">
                        <ul>
                            <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div> <!-- .page-pagination .text-center -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .blog -->
@endsection
