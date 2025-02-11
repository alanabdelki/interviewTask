@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="{{ $product->name }}">
                @endif
            </div>
            <div class="col-md-6">
                <h1 class="mb-4">{{ $product->name }}</h1>
                <p class="text-muted">{{ $product->description }}</p>
                <p><strong>السعر:</strong> {{ $product->price }} $</p>
                <p><strong>الكمية المتوفرة:</strong> {{ $product->stock }}</p>

                <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">
                    <i class="fas fa-arrow-left"></i> العودة إلى القائمة
                </a>
            </div>
        </div>
    </div>
@endsection
