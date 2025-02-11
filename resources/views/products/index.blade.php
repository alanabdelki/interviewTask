@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">المنتجات</h1>

        <a href="{{ route('products.create') }}" class="btn btn-success mb-4">
            <i class="fas fa-plus"></i> إضافة منتج جديد
        </a>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/150' }}"
                             class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>السعر:</strong> {{ $product->price }} $</p>
                            <p class="card-text"><strong>الكمية المتوفرة:</strong> {{ $product->stock }}</p>

                            <div class="d-flex gap-3">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm flex-fill">عرض</a>

                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm flex-fill">تعديل</a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('هل أنت متأكد من حذف المنتج؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm flex-fill">حذف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
