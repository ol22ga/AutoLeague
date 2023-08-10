<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::query()
            ->paginate(7);

        return response()->json([
            'brands' => $brands->items(),
            'current_page' => $brands->currentPage(),
            'last_page' => $brands->lastPage()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title' => ['required', 'unique:brands'],
            'img' => ['required', 'mimes:png,jpg,jpeg,bmb'],
        ],[
            'title.required' => 'Обязательное поле',
            'title.unique' => 'Марка уже существует',
            'img.required' => 'Обязательное поле',
            'img.mimes' => 'Разрешенные форматы: png,jpg,jpeg,bmb',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $path_img = '';
        if ($request->file()) {
            $path_img = $request->file('img')->store('/img/brands');
        }

        $brand = new Brand();
        $brand->title = $request->title;
        $brand->img = '/public/storage/' . $path_img;
        $brand->save();

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
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand, Request $request)
    {
        $brand = Brand::query()
            ->where('id', $request->id)
            ->first();

        $validate = Validator::make($request->all(), [
            'title' => ['required'],
            'img' => ['mimes:png,jpg,jpeg,bmb'],
        ],[
            'title.required' => 'Обязательное поле',
            'img.mimes' => 'Разрешенные форматы: png,jpg,jpeg,bmb',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        if (mb_strtolower($brand->title) !== mb_strtolower($request->title)) {
            $validate = Validator::make($request->all(), [
                'title' => ['unique:brands'],
            ],[
                'title.unique' => 'Марка уже существует'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }
        }

        $path_img = '';
        if ($request->file()) {
            $path = str_replace('/public/storage/', '', $brand->img);
            Storage::delete($path);

            $path_img = $request->file('img')->store('/img/brands');
            $brand->img = '/public/storage/' . $path_img;
        }

        $brand->title = $request->title;
        $brand->update();

        return response()->json('OK', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand, Request $request)
    {
        $brand = Brand::query()
            ->where('id', $request->id)
            ->first();

        $path = str_replace('/public/storage/', '', $brand->img);
        Storage::delete($path);

        $brand->delete();

        return response()->json('OK', 200);
    }
}
