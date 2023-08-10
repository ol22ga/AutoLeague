<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'images' => ['required'],
        ],[
            'images.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        foreach ($request->file('images') as $item) {
            $path_img = $item->store('/img/categories');

            $product_img = new ProductImage();
            $product_img->img = '/public/storage/' . $path_img;
            $product_img->product_id = $request->product_id;
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
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImage, Request $request)
    {
        $image = ProductImage::query()
            ->where('id', $request->id)
            ->first();

        $path = str_replace('/public/storage/', '', $image->img);
        Storage::delete($path);

        $image->delete();

        return response()->json('OK', 200);
    }
}
