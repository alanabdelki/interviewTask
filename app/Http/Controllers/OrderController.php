<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'products')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $cartData = json_decode($request->products, true);

        if (!$cartData || count($cartData) === 0) {
            return back()->with('error', 'السلة فارغة، يرجى إضافة منتجات أولاً!');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => array_reduce($cartData, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0),
        ]);

        foreach ($cartData as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price_at_purchase'=>$item['price']
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'تم إنشاء الطلب بنجاح!');
    }
}
