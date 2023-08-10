<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manufacturers = Manufacturer::query()
            ->paginate(7);

        return response()->json([
            'manufacturers' => $manufacturers->items(),
            'current_page' => $manufacturers->currentPage(),
            'last_page' => $manufacturers->lastPage()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title' => ['required', 'unique:manufacturers'],
        ],[
            'title.required' => 'Обязательное поле',
            'title.unique' => 'Производитель уже существует',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $manufacturer = new Manufacturer();
        $manufacturer->title = $request->title;
        $manufacturer->save();

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
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturer $manufacturer, Request $request)
    {
        $manufacturer = Manufacturer::query()
            ->where('id', $request->id)
            ->first();

        $validate = Validator::make($request->all(), [
            'title' => ['required'],
        ],[
            'title.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        if (mb_strtolower($manufacturer->title) !== mb_strtolower($request->title)) {
            $validate = Validator::make($request->all(), [
                'title' => ['unique:manufacturers'],
            ],[
                'title.unique' => 'Производитель уже существует'
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }
        }

        $manufacturer->title = $request->title;
        $manufacturer->update();

        return response()->json('OK', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer, Request $request)
    {
        $manufacturer = Manufacturer::query()
            ->where('id', $request->id)
            ->delete();

        return response()->json('OK', 200);
    }
}
