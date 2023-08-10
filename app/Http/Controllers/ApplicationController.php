<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::query()
            ->where('status', 'Новая')
            ->paginate(10);

        return response()->json([
            'applications' => $applications->items(),
            'current_page' => $applications->currentPage(),
            'last_page' => $applications->lastPage()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'regex:/[А-Яа-яЁё-]/u'],
            'phone' => ['required', 'regex:/^(?:\+7|8|7)?[- ]?(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{2}[- ]?\d{2}$/'],
            'text' => ['required'],
        ],[
            'name.required' => 'Обязательное поле',
            'name.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'phone.required' => 'Обязательное поле',
            'phone.regex' => 'Поле должно содержать номер телефона',
            'text.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $application = new Application($request->all());
        $application->save();

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
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application, Request $request)
    {
        $application = Application::query()
            ->where('id', $request->id)
            ->first();

        $application->status = 'Завершена';
        $application->update();

        return response()->json('OK', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
