<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query()
            ->where('status', '!=', 'Новый');

        if ($request->has('status_order')) {
            $query = $query->where('status', $request->status_order);
        }

        $orders = $query->with('carts', 'user', 'carts.product')
            ->paginate(7);

        return response()->json([
            'orders' => $orders->items(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstname' => ['required', 'regex:/[А-Яа-яЁё-]/u'],
            'lastname' => ['required', 'regex:/[А-Яа-яЁё-]/u'],
            'phone' => ['required', 'regex:/^(?:\+7|8|7)?[- ]?(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{2}[- ]?\d{2}$/'],
            'email' => ['required', 'email:frc'],
            'address' => ['required'],
        ],[
            'firstname.required' => 'Обязательное поле',
            'firstname.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'lastname.required' => 'Обязательное поле',
            'lastname.regex' => 'Поле может содержать только буквы русского алфавита, пробел и тире',
            'phone.required' => 'Обязательное поле',
            'phone.regex' => 'Поле должно содержать номер телефона',
            'email.required' => 'Обязательное поле',
            'email.email' => 'Поле должно содержать адрес электронной почты',
            'address.required' => 'Обязательное поле',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = User::query()
            ->where('id', Auth::id())
            ->first();
        if ($user->firstname == null) {
            $user->firstname = $request->firstname;
        }
        if ($user->lastname == null) {
            $user->lastname = $request->lastname;
        }
        if ($user->email == null) {
            $user->email = $request->email;
        }
        $user->update();

        $order = Order::query()
            ->where('id', $request->id)
            ->first();
        $order->status = 'В обработке';
        $order->address = $request->address;
        $order->update();

        return redirect()->route('AccountPage');
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
    public function show(Order $order)
    {
        $orders = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'Новый')
            ->with('carts', 'carts.product')
            ->get();

        return response()->json([
            'orders' => $orders
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'status_order' => ['required'],
        ],[
            'status_order.required' => 'Обязательное поле',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        if ($request->status_order == 'Отклонен') {
            $validate = Validator::make($request->all(), [
                'comment' => ['required'],
            ],[
                'comment.required' => 'Обязательное поле',
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
            }
        }
        $order = Order::query()
            ->where('id', $request->id)
            ->first();

        $carts = Cart::query()
            ->where('order_id', $order->id)
            ->get();
        foreach ($carts as $cart) {
            $product = Product::query()->where('id', $cart->product_id)->first();

            if ($cart->count <= $product->count) {
                $product->count -= $cart->count;
                $product->buy += $cart->count;
                $order->status = $request->status_order;
                $order->comment = $request->comment;
            } else {
                $order->status = 'Отклонен';
                $order->comment = 'На складе не хватает товара "' . $product->article . '". Невозможно одобрить заказ. ';
            }
        }
        $order->update();
        return response()->json('OK', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, Request $request)
    {
        $order = Order::query()
            ->where('id', $request->id)
            ->delete();

        return response()->json('OK', 200);
    }
}
