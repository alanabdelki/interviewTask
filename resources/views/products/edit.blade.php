@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">تعديل المنتج</div>
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">اسم المنتج</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">السعر</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" step="0.01" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="stock" class="form-label">الكمية في المخزون</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock    }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">صورة المنتج:</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" width="100">
                        @endif
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">تحديث المنتج</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
