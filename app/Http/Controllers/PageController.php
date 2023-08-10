<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //ОБЩИЕ СТРАНИЦЫ
    public function MainPage() {
        $categories = Category::query()
            ->inRandomOrder()
            ->take(8)
            ->withCount('products')
            ->get();
        $brands = Brand::all();
        $new_products = Product::query()
            ->orderBy('created_at')
            ->limit(10)
            ->with('product_images')
            ->get();
        $new_products = Product::query()
            ->orderBy('created_at')
            ->limit(10)
            ->with('product_images')
            ->get();
        $hit_of_sales = Product::query()
            ->orderBy('buy')
            ->limit(10)
            ->get();
        return view('welcome', ['categories'=>$categories, 'brands'=>$brands, 'new_products'=>$new_products, 'hit_of_sales'=>$hit_of_sales]);
    }
    public function AboutUsPage() {
        return view('about-us');
    }
    public function CatalogPage() {
        return view('catalog');
    }
    public function ProductDetailsPage(Request $request) {
        $product = Product::query()
            ->where('id', $request->id)
            ->with('product_images', 'category', 'brand', 'manufacturer')
            ->first();

        return view('details.product', ['product' => $product]);
    }
    public function ProductDetailsModal(Request $request) {
        return view('layout.modal.product');
    }
    public function ContactPage() {
        return view('contact');
    }
    public function FaqPage() {
        $questions = Question::query()
            ->where('answer', '!=', 'null')
            ->get();

        return view('faq', ['questions' => $questions]);
    }
    public function BlogPage() {
        return view('blog');
    }
    public function ArticleDetailsPage() {
        return view('details.article');
    }
    public function PrivacyPage() {
        return view('privacy-policy');
    }




    //СТРАНИЦЫ ГОСТЯ
    public function LoginPage() {
        return view('guest.login');
    }
    public function LoginPasswordPage() {
        return view('guest.login-password');
    }
    public function RegistrationPage() {
        return view('guest.registration');
    }




    //СТРАНИЦЫ АВТОРИЗОВАННОГО ПОЛЬЗОВАТЕЛЯ
    public function AccountPage() {
        return view('user.personal-account');
    }
    public function CartPage() {
        return view('user.cart');
    }
    public function CheckoutPage() {
        return view('user.checkout');
    }
    public function WishlistPage() {
        return view('user.wishlist');
    }
    public function ComparePage() {
        return view('user.compare');
    }




    //СТРАНИЦЫ АДМИНИСТРАТОРА
    public function CategoriesPage() {
        return view('admin.categories');
    }
    public function BrandsPage() {
        return view('admin.brands');
    }
    public function ManufacturersPage() {
        return view('admin.manufacturers');
    }
    public function ProductsPage() {
        return view('admin.products');
    }
    public function OrdersPage() {
        return view('admin.orders');
    }
    public function ApplicationsPage() {
        return view('admin.applications');
    }
    public function QuestionsPage() {
        return view('admin.questions');
    }
}
