@extends('layout.app')
@section('title', 'Ошибка')
@section('content')
    <div class="error section-top-gap-100">
        <div class="container">
            <div class="row">
                <div>
                    <h1>404</h1>
                    <h4>Упс! Страница не найдена</h4>
                    <p>Извините, но страница, которую вы ищете, не существует, была удалена, название изменено или временно недоступна.</p>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-sm-6 col-8">
                            <a href="{{route('MainPage')}}" class="button">На главную</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
