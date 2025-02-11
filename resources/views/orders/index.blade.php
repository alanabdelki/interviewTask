@extends('layouts.app')

@section('content')
    <h1>الطلبات</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-success mb-4">
        <i class="fas fa-plus"></i> إضافة طلب جديد
    </a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>رقم الطلب</th>
            <th>اسم المستخدم</th>
            <th>تاريخ الطلب</th>
            <th>المبلغ الإجمالي</th>
            <th>المنتجات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ number_format($order->total_amount, 2) }} ريال</td>
                <td>
                    <ul>
                        @foreach($order->products as $product)
                            <li>
                                {{ $product->name }} -
                                <strong>الكمية:</strong> {{ $product->pivot->quantity }} -
                                <strong>السعر وقت الشراء:</strong> {{ number_format($product->pivot->price_at_purchase, 2) }} ريال
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
