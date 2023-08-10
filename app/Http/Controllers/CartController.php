<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'Новый')
            ->firstOrNew(['user_id' => Auth::id()], ['status' => 'Новый']);

        $carts = Cart::query()
            ->where('order_id', $order->id)
            ->with('product', 'product.product_images', 'order')
            ->get();

        return response()->json([
            'carts' => $carts,
            'order' => $order
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product = Product::query()
            ->where('id', $request->id)
            ->first();

        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'Новый')
            ->firstOrCreate(['user_id' => Auth::id()], ['status' => 'Новый']);

        $cart = Cart::query()
            ->where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->firstOrCreate(['order_id' => $order->id], ['product_id' => $product->id]);

        if ($cart->count) {
            if ($product->count > $cart->count) {
                //на складе достаточно товара
                $cart->count += 1;
                $cart->price += $product->new_price;
                $order->price += $product->new_price;
                $order->discount += $product->old_price - $product->new_price;
                $order->save();
                $cart->save();
                return response()->json('OK', 200);
            } else {
                //на складе недостаточно товара
                return response()->json('ERROR', 400);
            }
        } else {
            $cart->count = 1;
            $cart->price = $product->new_price;
            $order->price += $product->new_price;
            $order->discount += $product->old_price - $product->new_price;
            $order->save();
            $cart->save();
            return response()->json('OK', 200);
        }
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
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart, Request $request)
    {
        $product = Product::query()
            ->where('id', $request->id)
            ->first();

        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'Новый')
            ->firstOrCreate(['user_id' => Auth::id()], ['status' => 'Новый']);

        $cart = Cart::query()
            ->where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->firstOrCreate(['order_id' => $order->id], ['product_id' => $product->id]);

        if ($cart->count > 1) {
            $cart->count -= 1;
            $cart->price -= $product->new_price;
            $order->price -= $product->new_price;
            $order->discount -= $product->old_price - $product->new_price;
            $order->update();
            $cart->update();
            return response()->json('OK', 200);
        } else {
            $order->price -= $product->new_price;
            $order->discount -= $product->old_price - $product->new_price;
            $order->update();
            $cart->delete();
            return response()->json('OK', 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart, Request $request)
    {
        $product = Product::query()
            ->where('id', $request->id)
            ->first();

        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'Новый')
            ->firstOrCreate(['user_id' => Auth::id()], ['status' => 'Новый']);

        $cart = Cart::query()
            ->where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->firstOrCreate(['order_id' => $order->id], ['product_id' => $product->id]);

        $order->price -= $cart->price;
        $order->discount -= ($product->old_price - $product->new_price) * $cart->count;

        $order->update();
        $cart->delete();
        return response()->json('OK', 200);
    }
}
