<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryMetal;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()
            ->paginate(7);

        return response()->json([
            'categories' => $categories->items(),
            'current_page' => $categories->currentPage(),
            'last_page' => $categories->lastPage()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title' => ['required', 'unique:categories'],
            'img' => ['required', 'mimes:png,jpg,jpeg,bmb'],
        ],[
            'title.required' => 'Обязательное поле',
            'title.unique' => 'Категория уже существует',
            'img.required' => 'Обязательное поле',
            'img.mimes' => 'Разрешенные форматы: png,jpg,jpeg,bmb',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $path_img = '';
        if ($request->file()) {
            $path_img = $request->file('img')->store('/img/categories');
        }

        $category = new Category();
        $category->title = $request->title;
        $category->img = '/public/storage/' . $path_img;
        $category->save();

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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Request $request)
    {
        $category = Category::query()
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

        if (mb_strtolower($category->title) !== mb_strtolower($request->title)) {
            $validate = Validator::make($request->all(), [
                'title' => ['unique:categories'],
            ],[
                'title.unique' => 'Категория уже существует'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }
        }

        $path_img = '';
        if ($request->file()) {
            $path = str_replace('/public/storage/', '', $category->img);
            Storage::delete($path);

            $path_img = $request->file('img')->store('/img/categories');
            $category->img = '/public/storage/' . $path_img;
        }

        $category->title = $request->title;
        $category->update();

        return response()->json('OK', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request)
    {
        $category = Category::query()
            ->where('id', $request->id)
            ->first();

        $path = str_replace('/public/storage/', '', $category->img);
        Storage::delete($path);

        $category->delete();

        return response()->json('OK', 200);
    }
}
