<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




//------------------------------------------ОБЩИЕ СТРАНИЦЫ------------------------------------------
Route::get('/', [PageController::class, 'MainPage'])->name('MainPage');
Route::get('/about', [PageController::class, 'AboutUsPage'])->name('AboutUsPage');
Route::get('/contact', [PageController::class, 'ContactPage'])->name('ContactPage');
Route::get('/faq', [PageController::class, 'FaqPage'])->name('FaqPage');
Route::get('/catalog', [PageController::class, 'CatalogPage'])->name('CatalogPage');
Route::get('/blog', [PageController::class, 'BlogPage'])->name('BlogPage');
Route::get('/privacy', [PageController::class, 'PrivacyPage'])->name('PrivacyPage');
Route::get('/article', [PageController::class, 'ArticleDetailsPage'])->name('ArticleDetailsPage');
Route::get('/product', [PageController::class, 'ProductDetailsPage'])->name('ProductDetailsPage');




//-----------------------------------------ОБЩИЙ ФУНКЦИОНАЛ-----------------------------------------
//---получение данных
Route::get('/categories/get', [CategoryController::class, 'index'])->name('CategoriesGet');
Route::get('/brands/get', [BrandController::class, 'index'])->name('BrandsGet');
Route::get('/manufacturers/get', [ManufacturerController::class, 'index'])->name('ManufacturersGet');
Route::get('/products/get', [ProductController::class, 'index'])->name('ProductsGet');
Route::get('/products/settings/get', [ProductController::class, 'get'])->name('ProductSettingsGet');

//---оформление заявки
Route::post('/application/send', [ApplicationController::class, 'create'])->name('ApplicationSend');




//-------------------------------------------------ГОСТЬ--------------------------------------------
Route::group(['middleware' => 'guest'], function () {
    //---регистрация
    Route::get('/registration', [PageController::class, 'RegistrationPage'])->name('RegistrationPage');
    Route::post('/registration/save', [UserController::class, 'Registration'])->name('Registration');

    //---авторизация по номеру телефона
    Route::get('/login', [PageController::class, 'LoginPage'])->name('LoginPage');
    Route::post('/login/send/message', [UserController::class, 'SendMessage'])->name('SendMessage');
    Route::post('/login/entry', [UserController::class, 'LoginPhone'])->name('LoginPhone');

    //---авторизация по паролю
    Route::get('/login/password', [PageController::class, 'LoginPasswordPage'])->name('LoginPasswordPage');
    Route::post('/login/password/entry', [UserController::class, 'LoginPassword'])->name('LoginPassword');
});




//--------------------------------------АВТОРИЗОВАННЫЙ ПОЛЬЗОВАТЕЛЬ----------------------------------
Route::group(['middleware' => 'auth'], function () {
    //---выход
    Route::get('/logout', [UserController::class, 'Logout'])->name('Logout');

    //---корзина
    Route::get('/cart', [PageController::class, 'CartPage'])->name('CartPage');
    Route::get('/cart/get', [CartController::class, 'index'])->name('GetCart');
    Route::post('/cart/add', [CartController::class, 'create'])->name('AddToCart');
    Route::post('/cart/decrement', [CartController::class, 'edit'])->name('DecrementToCart');
    Route::post('/cart/delete', [CartController::class, 'destroy'])->name('DeleteFromCart');

    //---оформление заказа
    Route::get('/checkout', [PageController::class, 'CheckoutPage'])->name('CheckoutPage');
    Route::get('/user/get', [UserController::class, 'UserGet'])->name('UserGet');
    Route::post('/order/place', [OrderController::class, 'create'])->name('PlaceAnOrder');

    //---вопрос
    Route::post('/ask', [QuestionController::class, 'create'])->name('Ask');

    //---личный кабинет
    Route::get('/account', [PageController::class, 'AccountPage'])->name('AccountPage');
    Route::post('/user/edit', [UserController::class, 'UserEdit'])->name('UserEdit');
    //---заказы
    Route::get('/orders/user/get', [OrderController::class, 'show'])->name('MyOrdersGet');
    Route::post('/order/reject', [OrderController::class, 'destroy'])->name('OrderReject');

    Route::get('/wishlist', [PageController::class, 'WishlistPage'])->name('WishlistPage');
    Route::get('/compare', [PageController::class, 'ComparePage'])->name('ComparePage');
});




//----------------------------------------------АДМИН-ПАНЕЛЬ-----------------------------------------
Route::group(['middleware' => 'admin'], function () {
    //---категории
    Route::get('/categories', [PageController::class, 'CategoriesPage'])->name('CategoriesPage');
    Route::post('/category/add', [CategoryController::class, 'create'])->name('CategoryAdd');
    Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('CategoryDelete');
    Route::post('/category/edit', [CategoryController::class, 'edit'])->name('CategoryEdit');

    //---марки
    Route::get('/brands', [PageController::class, 'BrandsPage'])->name('BrandsPage');
    Route::post('/brand/add', [BrandController::class, 'create'])->name('BrandAdd');
    Route::post('/brand/delete', [BrandController::class, 'destroy'])->name('BrandDelete');
    Route::post('/brand/edit', [BrandController::class, 'edit'])->name('BrandEdit');

    //---производители
    Route::get('/manufacturers', [PageController::class, 'ManufacturersPage'])->name('ManufacturersPage');
    Route::post('/manufacturer/add', [ManufacturerController::class, 'create'])->name('ManufacturerAdd');
    Route::post('/manufacturer/delete', [ManufacturerController::class, 'destroy'])->name('ManufacturerDelete');
    Route::post('/manufacturer/edit', [ManufacturerController::class, 'edit'])->name('ManufacturerEdit');

    //---товары
    Route::get('/products', [PageController::class, 'ProductsPage'])->name('ProductsPage');
    Route::post('/product/add', [ProductController::class, 'create'])->name('ProductAdd');
    Route::post('/product/delete', [ProductController::class, 'destroy'])->name('ProductDelete');
    Route::post('/product/edit', [ProductController::class, 'edit'])->name('ProductEdit');

    //---фото товаров
    Route::post('/product/image/delete', [ProductImageController::class, 'destroy'])->name('ImageDelete');
    Route::post('/product/image/add', [ProductImageController::class, 'create'])->name('ImageAdd');

    //---заказы
    Route::get('/orders', [PageController::class, 'OrdersPage'])->name('OrdersPage');
    Route::get('/orders/get', [OrderController::class, 'index'])->name('OrdersGet');
    Route::post('/order/edit', [OrderController::class, 'edit'])->name('OrderAccept');

    //---заявки
    Route::get('/applications', [PageController::class, 'ApplicationsPage'])->name('ApplicationsPage');
    Route::get('/applications/get', [ApplicationController::class, 'index'])->name('ApplicationsGet');
    Route::post('/applications/complete', [ApplicationController::class, 'edit'])->name('ApplicationsComplete');

    //---вопросы
    Route::get('/questions', [PageController::class, 'QuestionsPage'])->name('QuestionsPage');
    Route::get('/questions/get', [QuestionController::class, 'index'])->name('QuestionsGet');
    Route::post('/question/edit', [QuestionController::class, 'edit'])->name('QuestionsEdit');
    Route::post('/question/delete', [QuestionController::class, 'destroy'])->name('QuestionsDelete');
});
