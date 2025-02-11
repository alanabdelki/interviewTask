@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">إضافة منتج جديد</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">اسم المنتج:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">وصف المنتج:</label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="price">السعر:</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">صورة المنتج:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="stock">الكمية المتوفرة:</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">إضافة المنتج</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
        </form>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
