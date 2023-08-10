<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\File;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        $min_price = $query->min('new_price');
        $max_price = $query->max('new_price');

//        if ($request->has('category')) {
//            $query->where('category_id', $request->category);
//        }
//        if ($request->has('brand')) {
//            $query->where('brand_id', $request->brand);
//        }
//        if ($request->has('manufacturer')) {
//            $query->where('manufacturer_id', $request->manufacturer);
//        }
//
//        if ($request->has('min')) {
//            $query->where('new_price', '>=', $request->min);
//        }
//        if ($request->has('max')) {
//            $query->where('new_price', '<=', $request->max);
//        }

        $products = $query->with('category', 'manufacturer', 'brand', 'product_images')
            ->paginate($request->paginate);

//        $current_min_price = $query->min('new_price');
//        $current_max_price = $query->max('new_price');


        return response()->json([
            'products' => $products->items(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'min_price' => $min_price,
            'max_price' => $max_price,
//            'current_min_price' => $current_min_price,
//            'current_max_price' => $current_max_price,
        ], 200);
    }

    /**
     * Get resource settings.
     */
    public function get()
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $brands = Brand::all();

        return response()->json([
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'brands' => $brands,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'article' => ['required', 'numeric', 'digits:12'],
            'title' => ['required'],
            'description' => ['required'],
            'manufacturer_id' => ['required'],
            'complete_set' => ['required'],
            'material' => ['required'],
            'weight' => ['required'],
            'count' => ['required', 'numeric', 'between:0,10000'],
            'old_price' => ['required', 'numeric', 'min:1', 'max:999999'],
            'new_price' => ['required', 'numeric', 'min:1', 'max:999999'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'images' => ['required'],
        ],[
            'article.required' => 'Обязательное поле',
            'article.number' => 'Тип данных - числовой',
            'article.digits' => 'Длина артикула - 12 символов',
            'title.required' => 'Обязательное поле',
            'description.required' => 'Обязательное поле',
            'manufacturer_id.required' => 'Обязательное поле',
            'complete_set.required' => 'Обязательное поле',
            'material.required' => 'Обязательное поле',
            'weight.required' => 'Обязательное поле',
            'count.required' => 'Обязательное поле',
            'count.number' => 'Тип данных - числовой',
            'count.between' => 'Разрешенный диапазон цены от 1 до 10000',
            'old_price.required' => 'Обязательное поле',
            'old_price.numeric' => 'Тип данных - числовой',
            'old_price.min' => 'Цена должна быть больше 1 рубля',
            'old_price.max' => 'Цена должна быть меньше 1000000 рублей',
            'new_price.required' => 'Обязательное поле',
            'new_price.numeric' => 'Тип данных - числовой',
            'new_price.min' => 'Цена должна быть больше 1 рубля',
            'new_price.max' => 'Цена должна быть меньше 1000000 рублей',
            'category_id.required' => 'Обязательное поле',
            'brand_id.required' => 'Обязательное поле',
            'images.required' => 'Обязательное поле',
            'images.mimes' => 'Разрешенные форматы: png,jpg,jpeg,bmb',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $product = new Product($request->all());
        $product->save();

        foreach ($request->file('images') as $item) {
            $path_img = $item->store('/img/products');

            $product_img = new ProductImage();
            $product_img->img = '/public/storage/' . $path_img;
            $product_img->product_id = $product->id;
            $product_img->save();
        }

        return response()->json('OK', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, Request $request)
    {
        $validate = Validator::make($request->all(),[
            'article' => ['required', 'numeric', 'digits:12'],
            'title' => ['required'],
            'description' => ['required'],
            'manufacturer_id' => ['required'],
            'complete_set' => ['required'],
            'material' => ['required'],
            'weight' => ['required'],
            'count' => ['required', 'numeric', 'between:0,10000'],
            'old_price' => ['required', 'numeric', 'min:1', 'max:999999'],
            'new_price' => ['required', 'numeric', 'min:1', 'max:999999'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
        ],[
            'article.required' => 'Обязательное поле',
            'article.number' => 'Тип данных - числовой',
            'article.digits' => 'Длина артикула - 12 символов',
            'title.required' => 'Обязательное поле',
            'description.required' => 'Обязательное поле',
            'manufacturer_id.required' => 'Обязательное поле',
            'complete_set.required' => 'Обязательное поле',
            'material.required' => 'Обязательное поле',
            'weight.required' => 'Обязательное поле',
            'count.required' => 'Обязательное поле',
            'count.number' => 'Тип данных - числовой',
            'count.between' => 'Разрешенный диапазон цены от 1 до 10000',
            'old_price.required' => 'Обязательное поле',
            'old_price.numeric' => 'Тип данных - числовой',
            'old_price.min' => 'Цена должна быть больше 1 рубля',
            'old_price.max' => 'Цена должна быть меньше 1000000 рублей',
            'new_price.required' => 'Обязательное поле',
            'new_price.numeric' => 'Тип данных - числовой',
            'new_price.min' => 'Цена должна быть больше 1 рубля',
            'new_price.max' => 'Цена должна быть меньше 1000000 рублей',
            'category_id.required' => 'Обязательное поле',
            'brand_id.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $product = Product::findOrFail($request->id);
        $product->fill($request->all());
        $product->update();

        return response()->json('OK', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Request $request)
    {
        $product = Product::query()
            ->where('id', $request->id)
            ->delete();

        $images = ProductImage::query()
            ->where('product_id', $request->id)
            ->get();

        foreach ($images as $item) {
            $path = str_replace('/public/storage/', '', $item->img);
            Storage::delete($path);
        }

        return response()->json('OK', 200);
    }
}
