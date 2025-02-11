@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @auth
            <h1 class="display-4">منتجاتنا</h1>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card">
                            <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>السعر:</strong> {{ $product->price }} $</p>
                                <p class="card-text"><strong>الكمية المتوفرة:</strong> {{ $product->stock }}</p>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">تفاصيل المنتج</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h1 class="display-4">مرحباً بك في موقعنا</h1>
            <p class="lead">قم بتسجيل الدخول أو إنشاء حساب جديد للبدء</p>

            <div class="mt-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2">تسجيل الدخول</a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg mx-2">إنشاء حساب</a>
                @endif
            </div>
        @endauth
    </div>
@endsection
